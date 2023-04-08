<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\admin\NavigationController;
use App\Http\Controllers\admin\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/get-navigations', [NavigationController::class,'apiNavigations'])->name('get-navigations');
Route::get('/get-categories', [CategoryController::class,'apiCate'])->name('get-cate');
Route::get('/get-category/{catkey}', [CategoryController::class,'apiCateSlug'])->name('get-slug-cate');
Route::get('/get-posts', [PostController::class,'apiPosts'])->name('get-posts');
Route::get('/get-post/{poskey}', [PostController::class,'apiPostSlug'])->name('get-slug-post');
Route::get('/search-post/{searchkey}', [PostController::class,'apisearchpost'])->name('get-search-post');
