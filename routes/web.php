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

// Route::middleware(['CheckAuth'])->prefix('user')->group(function () {
//     Route::resource('computers', ComputresController::class)->except(['show', 'index', 'search', 'create', 'store']);
// });

Route::middleware(['auth', 'verified', 'CheckOwner'])->prefix('user')->name('user.')->group(function () {
    Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('destroy')->withoutMiddleware(['verified']);
    Route::delete('/destroyallcomputers/{id}', [UserController::class, 'destroyAllComputers'])->name('computers.destroyall');
    Route::put('/update/{id}', [UserController::class, 'update'])->name('edit')->withoutMiddleware('verified');
    Route::put('/updateprofileimage/{id}', [UserController::class, 'uploadProfileImage'])->name('editprofileImg');
    Route::get('/profile', [UserController::class, 'show'])->name('profile')->withoutMiddleware(['verified', 'CheckOwner']);
    Route::get('/download-pdf', [PdfUserController::class, 'downloadPDF'])->name('download.pdf')->withoutMiddleware(['CheckOwner']);
    Route::delete('/computer/destroy/{id}', [ComputresController::class, 'destroy'])->name('computers.destroy')->middleware(['CheckOwnerPc'])->withoutMiddleware(['CheckOwner']);
    Route::put('/computers/update/{id}', [ComputresController::class, 'update'])->name('computers.update')->middleware(['CheckOwnerPc'])->withoutMiddleware(['CheckOwner']);
    Route::get('/computer/editajax/{id}', [ComputresController::class, 'editajax'])->middleware(['CheckOwnerPc'])->withoutMiddleware(['CheckOwner']);
    Route::get('/computer/edit/{id}', [ComputresController::class, 'edit'])->name('computers.edit')->middleware(['CheckOwnerPc'])->withoutMiddleware(['CheckOwner']);
    Route::post('/computersave', [ComputresController::class, 'store'])->name('computers.store')->withoutMiddleware(['CheckOwner']);
    Route::get('/computers/create', [ComputresController::class, 'create'])->name('computers.create')->withoutMiddleware(['CheckOwner']);
    Route::get('/computers', [ComputresController::class, 'index'])->name('computers.index')->withoutMiddleware(['CheckOwner']);
});

Route::middleware(['guest'])->group(function () {
    Route::get('/auth/google/redirect', [GoogleSocialiteController::class, 'redirect'])->name("googleAuth");
    Route::get('/auth/google/callback', [GoogleSocialiteController::class, 'callback']);
});



Route::prefix('computers')->name('computers.')->group(function () {
    Route::get('', [navigation::class, 'index'])->name('index');
    Route::post('/search', [ComputresController::class, 'search'])->name('search');
    Route::get('/searchajax', [ComputresController::class, 'searchajax'])->name('searchajax');
    Route::get('/{computer}', [ComputresController::class, 'show'])->name('show');
});

Auth::routes(['verify' => true]);

Route::fallback(function () {
    return view('404page');
})->name('404');
