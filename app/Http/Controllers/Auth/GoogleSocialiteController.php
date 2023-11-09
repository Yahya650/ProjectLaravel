<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;
use Nette\Utils\Random;

class GoogleSocialiteController extends Controller
{
    private function generateRandomFileName($extension)
    {
        $randomString = Str::random(32); // Generate a random string
        $uniqueIdentifier = uniqid(); // Get a unique identifier

        $fileName = $randomString . $uniqueIdentifier . '.' . $extension;

        return $fileName;
    }

    private function downloadImageFromURL($imageUrl)
    {
        $response = Http::get($imageUrl);
        $extension = "png";
        $filename = $this->generateRandomFileName($extension);
        Storage::disk('public')->put('profileUser/' . $filename, $response->body());
        return "profileUser/" . $filename;
    }


    public function redirect()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }


    public function callback()
    {
        try {
            $NewUser = Socialite::driver('google')->stateless()->user();
            $userFinder = User::where('email', $NewUser->getEmail())->first();
            if ($userFinder) {
                Auth::login($userFinder);
                return redirect()->route('user.profile');
            } else {
                $user = new User();
                $user->name = $NewUser->name;
                $user->email = strtolower($NewUser->email);
                $user->social_id = $NewUser->id;
                $user->password = Hash::make(Random::generate());
                $user->profileImg = $this->downloadImageFromURL($NewUser->avatar);
                $user->social_type = "Google";
                $user->email_verified_at = now();

                $user->save();
                Auth::login($user);
                return redirect()->route('user.profile');
            }
        } catch (\Throwable $th) {
            return redirect('/')->with('messageErr', $th->getMessage());
        }
    }
}
