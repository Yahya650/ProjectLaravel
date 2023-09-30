<?php

use App\Http\Controllers\Navigation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use PHPUnit\TextUI\XmlConfiguration\Group;
use App\Http\Controllers\PdfUserController;
use App\Http\Controllers\computresController;
use App\Http\Controllers\Auth\GoogleSocialiteController;

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
    Route::delete('/destroyallcomputers/{id}', [UserController::class, 'destroyAllComputers'])->name('computers.destroyall')->middleware(['profileUpdateCheck'])->middleware('verified');
    Route::put('/update/{id}', [UserController::class, 'update'])->name('edit')->middleware(['profileUpdateCheck']);
    Route::put('/updateprofileimage/{id}', [UserController::class, 'uploadProfileImage'])->name('editprofileImg');
    Route::get('/profile', [UserController::class, 'show'])->name('profile');
    Route::post('/computersave', [ComputresController::class, 'store'])->name('computers.store')->middleware('verified');
    Route::get('/computers/create', [ComputresController::class, 'create'])->name('computers.create')->middleware('verified');
    Route::get('/download-pdf', [PdfUserController::class, 'downloadPDF'])->name('download.pdf')->middleware('verified');
    Route::get('/computers', [ComputresController::class, 'index'])->name('computers.index')->middleware('verified');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/auth/google/redirect', [GoogleSocialiteController::class, 'redirect'])->name("googleAuth");
    Route::get('/auth/google/callback', [GoogleSocialiteController::class, 'callback']);
});



Route::prefix('computers')->name('computers.')->group(function () {
    Route::get('', [navigation::class, 'index'])->name('index');
    Route::get('/search', [ComputresController::class, 'search'])->name('search');
    Route::get('/{computer}', [ComputresController::class, 'show'])->name('show');
});

Auth::routes(['verify' => true]);

Route::fallback(function () {
    return view('404page');
})->name('404');
