<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TagController;
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


// Route::get('/tags/{tag}', [TagController::class, 'show'])->name('tags.show');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/instagram', [HomeController::class, 'index'])->name('home.index');
    Route::post('/instagram/like', [HomeController::class, 'createLike'])->name('home.create-like');
    Route::post('/instagram/comment', [HomeController::class, 'createComment'])->name('home.create-comment');
    Route::post('/instagram/bookmark', [HomeController::class, 'createBookmark'])->name('home.bookmark');

    Route::get('/instagram/p/{post_id}', [PostController::class, 'view'])->name('posts.view')->where('id', '[0-9]+');
    Route::post('/instagram/p', [PostController::class, 'storeComment'])->name('posts.storeComment');
    Route::post('/instagram/p/like', [PostController::class, 'createLike'])->name('post.create-like');
    Route::post('/instagram/p/bookmark', [PostController::class, 'createBookmark'])->name('post.bookmark');
    Route::get('/instagram/explore/people/', [HomeController::class, 'showSuggestions'])->name('home.suggestions');

    Route::post('/profile/{username}/follow', [ProfileController::class, 'follow'])->name('profile.follow');
    Route::post('/profile/{username}/unfollow', [ProfileController::class, 'unfollow'])->name('profile.unfollow');
    Route::get('/profile/{username}/followers', [ProfileController::class, 'followers'])->name('profile.followers');
    Route::get('/profile/{username}/following', [ProfileController::class, 'following'])->name('profile.following');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/tags/suggest', [PostController::class, 'suggestTags'])->name('tags.suggest');

    Route::get('/tags/{tag_id}', [TagController::class, 'view'])->name('tags.view');
});

    Route::get('/profile/{username}', [ProfileController::class, 'show'])->name('profile.show');

require __DIR__.'/auth.php';

