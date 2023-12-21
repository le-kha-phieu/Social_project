<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Guest\UserController;
use App\Http\Controllers\User\BlogController;
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

Route::get('/create-blog',[BlogController::class, 'viewCreate'])->name('create.blog');
Route::post('/store-blog',[BlogController::class, 'store'])->name('post.blog');
Route::get('/{blog}/details',[BlogController::class, 'detail'])->name('detail');
Route::get('/{blog}/edit', [BlogController::class, 'edit'])->name('edit');
Route::put('/{blog}/update', [BlogController::class, 'update'])->name('update');
Route::delete('/{blog}/delete', [BlogController::class, 'delete'])->name('delete.blog'); 
Route::get('/search', [BlogController::class, 'searchBlog'])->name('search.blog');
Route::get('/search-my-blog', [BlogController::class, 'searchMyBlog'])->name('search.myBlog');

Route::get('/myBlog', [UserController::class, 'myBlog'])->name('myBlog');
Route::get('/profile', [UserController::class, 'editProfile'])->name('profile.user');
Route::put('/updateProfile', [UserController::class, 'updateProfile'])->name('updateProfile.user');



