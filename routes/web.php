<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;




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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
  Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');

Route::get('/reset-password', function () {
    return view('auth.reset-password');
})->name('reset.password');


use App\Http\Controllers\HomeController;

Route::get('/homes/create', [HomeController::class, 'create'])->name('homes.create');
Route::post('/homes', [HomeController::class, 'store'])->name('homes.store');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/homes/index', [HomeController::class, 'index'])->name('homes.index');
Route::get('/homes/show/{id}', [HomeController::class, 'show'])->name('homes.show');
Route::get('/homes/edit/{id}', [HomeController::class, 'edit'])->name('homes.edit');
Route::delete('/homes/{id}', [HomeController::class, 'destroy'])->name('homes.destroy');
Route::put('/homes/{id}', [HomeController::class, 'update'])->name('homes.update');

Route::get('/homes/search', [HomeController::class, 'search'])->name('homes.search');


Route::get('/change-password', [ChangePasswordController::class, 'showChangePasswordForm'])->name('change.password.form');


Route::get('/search-products', [HomeController::class, 'searchProducts'])->name('homes.searchProducts');

use App\Http\Controllers\LikeController;

// いいね
Route::post('/like/{homeId}', [LikeController::class, 'like'])->name('like');

// いいね解除
Route::post('/unlike/{homeId}', [LikeController::class, 'unlike'])->name('unlike');

use App\Http\Controllers\Auth\LoginController;

Route::get('/guest-login', [LoginController::class, 'guestLogin'])->name('guest.login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
