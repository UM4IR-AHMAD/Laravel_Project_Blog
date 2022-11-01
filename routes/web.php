<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BlogController;





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

Route::redirect('/', '/home');
Route::get('home', [BlogController::class, 'index'])->name('blog.home');
Route::get('postsByCategory/{category}', [BlogController::class, 'postsByCategory'])->name('blog.postsByCategory');
Route::get('postsByAuthor/{username}', [BlogController::class, 'postsByAuthor'])->name('blog.postsByAuthor');
Route::get('/post/{id}', [BlogController::class, 'show'])->name('blog.post.show');
Route::get('search', [BlogController::class, 'search'])->name('blog.search');

require __DIR__.'/auth.php';
require __DIR__.'/blogManagment.php';

