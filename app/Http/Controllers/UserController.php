<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Computer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class UserController extends Controller
{

    public function index()
    {
        // return view('User.index');
    }


    public function create()
    {
    }


    public function store(Request $request)
    {
        //
    }


    public function show()
    {
        $user = User::find(Auth::id());
        $computers = Computer::where('user_id', Auth::id())->latest()->paginate(5);
        // dd($computers);
        return view('User.index', compact('user', 'computers'));
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $oldImageProfile = $user->profileImg;
        if ($oldImageProfile == 'profileUser/90d6234278f61977c4e9d2c34836c418.jpg' || $oldImageProfile == 'profileUser/default-female-user-profile-icon-vector-illustration_276184-169.jpg') {
            if ($request->sexe == 'Female') {
                $user->profileImg = 'profileUser/default-female-user-profile-icon-vector-illustration_276184-169.jpg';
            } else {
                $user->profileImg = 'profileUser/90d6234278f61977c4e9d2c34836c418.jpg';
            }
        }
        try {
            $image = $request->file('image')->store('profileUser', 'public');
            $user->profileImg = $image;
            if ($oldImageProfile != 'profileUser/90d6234278f61977c4e9d2c34836c418.jpg' && $oldImageProfile != 'profileUser/default-female-user-profile-icon-vector-illustration_276184-169.jpg') {
                Storage::delete('public/' . $oldImageProfile);
            }
        } catch (\Throwable $th) {
        }

        $user->Name = $request->Name;
        $user->numeroTelephone = $request->Telephone;
        $user->sexe = $request->sexe;
        $user->save();
        return redirect()->route('user.profile')->with('success', 'Modify a été success');
    }


    public function uploadProfileImage(Request $request, $id)
    {
        // dd('fff');
        $user = User::find($id);
        $oldImageProfile = $user->profileImg;
        try {
            $image = $request->file('image')->store('profileUser', 'public');
            $user->profileImg = $image;
            if ($oldImageProfile != 'profileUser/90d6234278f61977c4e9d2c34836c418.jpg' && $oldImageProfile != 'profileUser/default-female-user-profile-icon-vector-illustration_276184-169.jpg') {
                Storage::delete('public/' . $oldImageProfile);
            }
        } catch (\Throwable $th) {
        }
        $user->save();
        return redirect()->back()->with('success', 'Profile Updated Successfuly');
    }

    public function destroy($id)
    {
        if (User::find($id)->profileImg != 'profileUser/90d6234278f61977c4e9d2c34836c418.jpg' && User::find($id)->profileImg != 'profileUser/default-female-user-profile-icon-vector-illustration_276184-169.jpg') {
            Storage::delete('public/' . User::find($id)->profileImg);
        }
        Computer::where('user_id', $id)->delete();
        User::find($id)->delete();
        return redirect()->back()->with('success', 'Suprimére a été success');
    }

    public function destroyAllComputers($idUser)
    {
        Computer::where('user_id', $idUser)->delete();
        return redirect()->back()->with('success', 'Suprimére a été success');
    }

    public function downloadPDF(Request $request)
    {
        $userData = [
            'name' => Auth::getName(),
            'email' => "a",
            // ... other user data fields
        ];
        $pdf = FacadePdf::loadView('PDF.userPdf', ['userData' => $userData]);
        return $pdf->download(Auth::getName() . '.pdf');
    }
}
