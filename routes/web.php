<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\NavigationController;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\admin\SubCategoryController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/manage-navigations', [NavigationController::class,'ShowNavigation'])->name('manage-navigations');
Route::get('/manage-navigations/categories/{navkey}', [NavigationController::class,'ShowNavCategory'])->name('add-navigation-categories');
Route::get('/manage-categories', [CategoryController::class,'ShowCategory'])->name('manage-categories');
Route::get('/manage-sub-categories', [SubCategoryController::class,'ShowsubCategory'])->name('manage-sub-categories');
Route::get('/add-posts', [PostController::class,'AddPost'])->name('add-post');
Route::Post('/savePost',[PostController::class,'storePost'])->name('savePost');
Route::get('/manage-posts', [PostController::class,'managePosts'])->name('manage-posts');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
