<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostImageController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\GithubAuthController;
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

Route::get('/auth/github', [GithubAuthController::class, 'redirect'])->name('auth.github');
Route::get('/auth/github/callback', [GithubAuthController::class, 'callback']);

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('login.attempt');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
    });
});

Route::get('/posts',
[PostController::class, 'index']
)->name('posts.index');

Route::middleware('auth')->group(function () {
    Route::get('/post/create',
    [PostController::class, 'create']);

    Route::post('/post/create',
    [PostController::class, 'store']
    )->name('post.store');

    Route::get('/post/edit/{post}',
    [PostController::class, 'edit']
    )->name('post.edit');

    Route::post('/post/{post}',
    [PostController::class, 'update']
    )->name('post.update');

    Route::post('/post/delete/{post}',
    [PostController::class, 'delete']
    )->name('post.delete');

    Route::post('/post/images/{post}',
    [PostImageController::class, 'store']
    )->name('post-images.store');
});

Route::get('/post/{post}',
[PostController::class, 'show']
)->name('post.show');
