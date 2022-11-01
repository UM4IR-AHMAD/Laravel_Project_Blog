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





# old style: cant call middleware after prefix
// Route::prefix('admin')->group(['middleware' => 'auth'], function(){


Route::middleware(['auth', 'verified'])->prefix('admin')->group(function(){
    // 'verified'
   


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
        Route::get('categories/search', [CategoryController::class, 'search'])->name('categories.search');
        Route::post('addCategory',[CategoryController::class,'store'])->name('category.store');
        // Route::get('/updateCategory/{id}',[CategoryController::class,'edit'])->name('category.edit');
        Route::post('updateCategory',[CategoryController::class,'update'])->name('category.update');
        Route::get('deleteCategory/{id}',[CategoryController::class,'destroy'])->name('category.delete');




        /* Route::prefix('/members')->group(function ()
        {
            
        }); */

            # members
            // Route::get('/members',[MembersController::class,'show'])->middleware('can:notAuthor')->name('members');
            Route::get('members',[MembersController::class,'show'])->name('members');

            Route::get('members/search',[MembersController::class,'search'])->name('members.search');

            # add new member
            Route::get('addMember',[MembersController::class, 'create'])->name('member.create');
            Route::post('addMember',[MembersController::class, 'insert'])->name('member.insert');

            # update member
            Route::get('updateMember/{id?}',[MembersController::class, 'edit'])->name('member.edit');
            Route::put('updateMember',[MembersController::class, 'update'])->name('member.update');

            # update member
            Route::put('updateEmali',[MembersController::class, 'updateEmail'])->name('member.updateEmail');

            # delete member
            Route::get('deleteMember/{id?}', [MembersController::class, 'delete'])->name('member.delete');
    });



    Route::get('profile',[ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('updateEmail', [ProfileController::class, 'updateEmail'])->name('profile.updateEmail');


    // dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('upload-logo', [SettingsController::class, 'store'])->name('settings.upload-logo');

});