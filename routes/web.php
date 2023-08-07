<?php

use App\Http\Controllers\navigation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\computresController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get("/", [Navigation::class, "index"])->name("index");
Route::get("/about", [Navigation::class, "about"])->name("about");
Route::get("/contact", [Navigation::class, "contact"])->name("contact");
Route::get("/search", [ComputresController::class, "search"])->name("search");
Route::resource('computers', ComputresController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
