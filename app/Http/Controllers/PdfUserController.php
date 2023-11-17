<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Computer;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PdfUserController extends Controller
{
    public function downloadPDF()
    {
        try {
            $user = User::find(Auth::id());
            $computers = Computer::get()->where('user_id', $user->id);
            $userData = [
                'name' => $user->name,
                'imageProfile' => $user->profileImg,
                'email' => $user->email,
                'sexe' => $user->sexe,
                'computers' => $computers,
            ];
            $pdf = FacadePdf::loadView('PDF.userPdf', $userData);
            return $pdf->download(now() . " " . str_replace(' ', '_', $user->name)  . '.pdf');
        } catch (\Throwable $th) {
            return redirect()->back()->with('messageErr', "Something went wrong");
        }
    }
}
