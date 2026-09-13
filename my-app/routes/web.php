<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Providers\RouteServiceProvider;

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


Route::get('/posts',
[PostController::class, 'index']);

Route::get('/posts2',
[PostController::class, 'index2']);

Route::get(
    '/posts3',
    [PostController::class, 'getPostWithQueryBuilder']
);

Route::post('/posts',
[PostController::class, 'store']);

Route::post(
    '/posts/create/normalsql', [PostController::class, 'createPostWithNormalSql']
);

Route::post(
    '/posts/create/bulk', [PostController::class, 'createBulkPostWithNormalSql']
);

Route::post(
    '/posts/update/normalsql', [PostController::class, 'updatePostWithNormalSql']
);

Route::post(
    '/posts/delete/normalsql', [PostController::class, 'deletePostWithNormalSql']
);

Route::post(
    '/posts/delete/querybuilder', [PostController::class, 'createPostWithQueryBuilder']
);

Route::get(
    '/posts/show/querybuilder',
    [PostController::class, 'getPostWithQueryBuilder']
);

Route::post(
    '/posts/update/querybuilder',
    [PostController::class, 'updatePostWithQueryBuilder']
);

Route::post(
    '/posts/delete/querybuilder',
    [PostController::class, 'deletePostWithQueryBuilder']
);

Route::get(
    '/posts/show/querybuilder/filters',
    [PostController::class, 
    'getPostWithQueryBuilderByFilter']
);

Route::get(
    '/posts/show/querybuilder/count',
    [PostController::class, 
    'getCountPosts']
);

Route::get(
    '/posts/show/querybuilder/join',
    [PostController::class, 'getPostAndUserWithQueryBuilder']
);

Route::get(
    '/posts/show/querybuilder/subquery',
    [PostController::class, 'getPostWithQueryBuilderBySubQuery']
);