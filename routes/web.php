<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Guest\HomeController;
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

Route::get('/',[HomeController::class, 'viewHome'])->name('homepage');
Route::get('/test', function () {
    return view('test');
});
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register',[AuthController::class, 'register'])->name('post.register');
Route::post('/login',[AuthController::class, 'login'])->name('post.login');
Route::get('/logout',[AuthController::class, 'logout'])->name('logout');
Route::get('/verify/{token}', [AuthController::class, 'verifyEmail'])->name('verify.email');

// Route::get('/', [HomeController::class, 'allBlogPublic'])->name('blogs.home');
