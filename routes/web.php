<?php

use App\Models\User;
use App\Http\Controllers\navigation;
use Illuminate\Support\Facades\Auth;
// use App\Http\Controllers\computresController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use PHPUnit\TextUI\XmlConfiguration\Group;
use \App\Http\Controllers\ComputresController;
use App\Http\Controllers\HomeController;

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



Route::get("/", [HomeController::class, "index"])->name("home");
Route::get("/about", [Navigation::class, "about"])->name("about");
Route::get("/contact", [Navigation::class, "contact"])->name("contact");

Route::middleware(['CheckAuth'])->prefix('user')->group(function () {
    Route::resource('computers', ComputresController::class)->except(['show', 'index', 'search', 'create', 'store']);
});

Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('destroy')->middleware(['profileUpdateCheck']);
    Route::delete('/destroyallcomputers/{id}', [UserController::class, 'destroyAllComputers'])->name('computers.destroyall')->middleware(['profileUpdateCheck']);
    Route::put('/update/{id}', [UserController::class, 'update'])->name('edit')->middleware(['profileUpdateCheck']);
    Route::put('/updateprofileimage/{id}', [UserController::class, 'uploadProfileImage'])->name('editprofileImg');
    Route::get('/profile', [UserController::class, 'show'])->name('profile');
    Route::post('/computers', [ComputresController::class, 'store'])->name('computers.store');
    Route::get('/computers/create', [ComputresController::class, 'create'])->name('computers.create');
    Route::get('/download-pdf', [UserController::class, 'downloadPDF'])->name('download.pdf');
    Route::get('/computers', [ComputresController::class, 'index'])->name('computers.index');
});

Route::prefix('computers')->name('computers.')->group(function () {
    Route::get('', [navigation::class, 'index'])->name('index');
    Route::get('/search', [ComputresController::class, 'search'])->name('search');
    Route::get('/{computer}', [ComputresController::class, 'show'])->name('show');
});

Auth::routes();



Route::fallback(function () {
    return view('404page');
})->name('404');