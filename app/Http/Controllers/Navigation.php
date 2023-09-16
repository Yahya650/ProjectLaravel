<?php

namespace App\Http\Controllers;

use App\Models\Computer;
use Illuminate\Http\Request;

class Navigation extends Controller
{
    public function index() {
        return view("computers")->with('computers',Computer::paginate(10));
    }
    public function about() {
        return view("about");
    }
    public function contact() {
        return view("contact");
    }
}
