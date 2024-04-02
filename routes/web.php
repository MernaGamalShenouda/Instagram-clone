<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/instagram', [HomeController::class, 'index'])->name('home.index');
Route::post('/instagram/like', [HomeController::class, 'createLike'])->name('home.create-like');
Route::post('/instagram/comment', [HomeController::class, 'createComment'])->name('home.create-comment');
Route::post('/instagram/bookmark', [HomeController::class, 'createBookmark'])->name('home.bookmark');

Route::get('/instagram/p/{post_id}', [PostController::class, 'view'])->name('posts.view')->where('id', '[0-9]+');
