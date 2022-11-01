<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;


class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalCategories = Category::count();
        $totalPosts = Post::count();
        $totalViews = Post::sum('views');
        $yourPosts = Post::where('user_id', auth()->user()->id)->count();
        $yourViews = Post::where('user_id', auth()->user()->id)->sum('views');

        return view('dashboard', compact('totalUsers', 'totalCategories', 'totalPosts', 'totalViews', 'yourPosts', 'yourViews'));
    }
}
