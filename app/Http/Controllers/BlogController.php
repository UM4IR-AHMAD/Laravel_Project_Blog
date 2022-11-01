<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class BlogController extends Controller
{
    //
    public function index()
    {
        $categories = $this->getCategories();
        $corusalPosts = Post::orderBy('id', 'DESC')->take(5)->get();
        $posts = Post::orderBy('id', 'DESC')->paginate(6);
        $topPosts = Post::orderBy('views', 'DESC')->take(6)->get();
      
        return view('blog.home', compact('categories', 'corusalPosts', 'posts', 'topPosts'));
    }


     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories = $this->getCategories();
        
        // increase views of post
        Post::find($id)->increment('views');

        $post = Post::find($id);
        $posts = Post::where('id', '!=', $id)->where('user_id', $post->user_id)->orderBy('id', 'DESC')->take(3)->get();
        $topPosts = Post::orderBy('views', 'DESC')->take(6)->get();


        return view('blog.post', compact('categories' ,'post', 'posts', 'topPosts'));
    }

    public function getCategories()
    {
        return Category::get();
    }


    public function postsByCategory($category)
    {
        $categories = $this->getCategories();
        $posts = Post::whereRelation('category', 'category', $category)->orderBy('id', 'DESC')->paginate(6);
        $topPosts = Post::orderBy('views', 'DESC')->take(6)->get();

        return view('blog.postsByCategory', compact('categories', 'posts', 'topPosts'));
    }

    public function postsByAuthor($username)
    {
        
        $categories = $this->getCategories();
        $posts = Post::whereRelation('user','username', $username)->orderBy('id', 'DESC')->paginate(6);
        $topPosts = Post::orderBy('views', 'DESC')->take(6)->get();

        return view('blog.postsByAuthor', compact('categories', 'posts', 'topPosts'));
    }


    public function search(Request $request){

        $categories = $this->getCategories();
        $topPosts = Post::orderBy('views', 'DESC')->take(6)->get();

        $search_input = $request->input();
        if (empty($search_input['search_by'])) {
            $search_input = $request->session()->get('search_input');
            $request->session()->flash('search_input', $search_input);            
        }
        else {
            $request->session()->flash('search_input', $search_input);
        }



        $search_by = $search_input['search_by'];
        $search = $search_input['search'];

        switch ($search_by) {
            case 'title':
                    $posts = Post::where('title','LIKE', '%'. $search .'%')->paginate(4);
                break;
            case 'user':
                    $posts = Post::whereRelation('user', 'name', 'LIKE',  $search . '%')->paginate(4);
                break;
        }

        return view('blog.search', compact('categories','posts', 'topPosts'));
    }
}
