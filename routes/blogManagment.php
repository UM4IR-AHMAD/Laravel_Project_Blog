<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DashboardController;




Route::middleware(['auth', 'verified'])->prefix('admin')->group(function(){
   


    # ------- posts ------
    # fetch posts
    Route::get('posts', [PostController::class, 'index'])->name('posts');
    Route::get('posts/mine', [PostController::class, 'myPosts'])->name('posts.mine');

    # search post
    Route::get('posts/search', [PostController::class, 'search'])->name('posts.search');

    # add new post
    Route::get('createPost', [PostController::class, 'create'])->name('post.create');
    Route::post('addPost', [PostController::class, 'store'])->name('post.store');

    # add new post
    Route::get('editPost/{id}', [PostController::class, 'edit'])->name('post.edit');
    Route::put('updatePost', [PostController::class, 'update'])->name('post.update');

    # preview
    Route::match(['post', 'put'],'/postPreview', [PostController::class, 'preview'])->name('post.preview');

    # discart add, update post
    Route::get('discartpost', [PostController::class, 'discart'])->name('post.discart');

    # delete a post
    Route::get('deletePosts/{id}', [PostController::class, 'destroy'])->name('post.delete');




    // ------- member routes -----
    Route::group(['middleware' => 'role'], function(){

        // ------- categories -------
        Route::get('categories', [CategoryController::class, 'index'])->name('categories');
        // search category
        Route::get('categories/search', [CategoryController::class, 'search'])->name('categories.search');
        // add category
        Route::post('addCategory',[CategoryController::class,'store'])->name('category.store');
        // update category
        Route::post('updateCategory',[CategoryController::class,'update'])->name('category.update');
        // delete category
        Route::get('deleteCategory/{id}',[CategoryController::class,'destroy'])->name('category.delete');



        // ------- Members -------
         // Route::get('/members',[MembersController::class,'show'])->middleware('can:notAuthor')->name('members');
         Route::get('members',[MembersController::class,'show'])->name('members');

         // search member
         Route::get('members/search',[MembersController::class,'search'])->name('members.search');

         # update member
         Route::get('updateMember/{id?}',[MembersController::class, 'edit'])->name('member.edit');
         Route::put('updateMember',[MembersController::class, 'update'])->name('member.update');

         # update member
         Route::put('updateEmali',[MembersController::class, 'updateEmail'])->name('member.updateEmail');

         # delete member
         Route::get('deleteMember/{id?}', [MembersController::class, 'delete'])->name('member.delete');

           
    });


    // ------- Profile -------
    // Profile view
    Route::get('profile',[ProfileController::class, 'edit'])->name('profile.edit');
    // Update info
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    // update Email Address
    Route::put('updateEmail', [ProfileController::class, 'updateEmail'])->name('profile.updateEmail');



    // ------- dashboard -------
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // ------- settings -------
    Route::get('settings', [SettingsController::class, 'index'])->name('settings');
    // update logo
    Route::post('upload-logo', [SettingsController::class, 'store'])->name('settings.upload-logo');

});