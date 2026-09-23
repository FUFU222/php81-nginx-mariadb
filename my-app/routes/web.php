<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostImageController;
use App\Providers\RouteServiceProvider;
use App\Models\User;

// Route::get('/user/{id}', User::class .
// '@getUserById');

Route::get('/posts',
[PostController::class, 'index']
)->name('posts.index');

Route::get('/post/create',
[PostController::class, 'create']);

Route::post('/post/create',
[PostController::class, 'store']
)->name('post.store');

Route::get('/post/{post}',
[PostController::class, 'show']
)->name('post.show');

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




// Route::get('/posts2',
// [PostController::class, 'index2']
// );

// Route::get('posts/redirect',
// [PostController::class, 'indexRedirect']);

// Route::get(
//     '/posts3',
//     [PostController::class, 'getPostWithQueryBuilder']
// );

// // Prefix 頭にposts/がつく場合の省略記法
// Route::prefix('posts')->group(function () {
//     Route::get('/create',
//     [PostController::class, 'create']);
//     Route::get('/edit',
//     [PostController::class, 'edit']);
//     Route::get('/show',
//     [PostController::class, 'show']);
//     Route::get('/delete',
//     [PostController::class, 'delete']);
// });

// Route::post('/posts',
// [PostController::class, 'store']);

// Route::post(
//     '/posts/create/normalsql', [PostController::class, 'createPostWithNormalSql']
// );

// Route::post(
//     '/posts/create/bulk', [PostController::class, 'createBulkPostWithNormalSql']
// );

// Route::post(
//     '/posts/update/normalsql', [PostController::class, 'updatePostWithNormalSql']
// );

// Route::post(
//     '/posts/delete/normalsql', [PostController::class, 'deletePostWithNormalSql']
// );

// Route::post(
//     '/posts/delete/querybuilder', [PostController::class, 'createPostWithQueryBuilder']
// );

// Route::get(
//     '/posts/show/querybuilder',
//     [PostController::class, 'getPostWithQueryBuilder']
// );

// Route::post(
//     '/posts/update/querybuilder',
//     [PostController::class, 'updatePostWithQueryBuilder']
// );

// Route::post(
//     '/posts/delete/querybuilder',
//     [PostController::class, 'deletePostWithQueryBuilder']
// );

// Route::get(
//     '/posts/show/querybuilder/filters',
//     [PostController::class, 
//     'getPostWithQueryBuilderByFilter']
// );

// Route::get(
//     '/posts/show/querybuilder/count',
//     [PostController::class, 
//     'getCountPosts']
// );

// Route::get(
//     '/posts/show/querybuilder/join',
//     [PostController::class, 'getPostAndUserWithQueryBuilder']
// );

// Route::get(
//     '/posts/show/querybuilder/subquery',
//     [PostController::class, 'getPostWithQueryBuilderBySubQuery']
// );

// Route::get(
//     '/posts/show/eloquent',
//     [PostController::class, 'getPostWithEloquent']
// );

// Route::get(
//     '/posts/show/eloquent/{id}',
//     [PostController::class, 'getPostWithEloquentById']
// );

// Route::get(
//     '/posts/show/eloquent/{id}',
//     [PostController::class, 'getPostWithEloquentById']
// );

// Route::get(
//     '/posts/trashed',
//     [PostController::class, 'getTrashedPostWithEloquent']
// );

// Route::post(
//     '/posts/create/eloquent',
//     [PostController::class, 'createPostWithEloquent']
// );

// Route::post(
//     '/posts/update/eloquent',
//     [PostController::class, 'updatePostWithEloquent']
// );

// Route::post(
//     'posts/delete/eloquent/{id}',
//     [PostController::class, 'deletePostWithEloquent']
// );