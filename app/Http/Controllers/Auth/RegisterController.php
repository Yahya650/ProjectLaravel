<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'lname' => ['required', 'string', 'max:255'],
            'fname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }


    protected function create(array $data)
    {
        $defaultImage = $data['sexe'] == 'Male' ? 'profileUser/90d6234278f61977c4e9d2c34836c418.jpg' : 'profileUser/default-female-user-profile-icon-vector-illustration_276184-169.jpg';

        return User::create([
            'name' => $data['lname'] . " " . $data['fname'],
            'email' => $data['email'],
            'sexe' => $data['sexe'],
            'profileImg' => $defaultImage,
            'password' => Hash::make($data['password']),
        ]);

        // $newUser = new User();
        // $newUser->name = $data['lname'] . " " . $data['fname'];
        // $newUser->email = $data['email'];
        // $newUser->sexe = $data['sexe'];
        // $newUser->profileImg = $defaultImage;
        // $newUser->password = Hash::make($data['password']);
        // $newUser->save();
        // Auth::login($newUser);
        // return redirect('user/profile')->with('success', 'Register Succesfuly');
    }
}
