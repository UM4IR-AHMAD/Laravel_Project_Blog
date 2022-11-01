<?php

namespace App\Http\Controllers;


use App\Models\Post;
use App\Models\Category;
use App\Models\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        //
        session()->forget('_old_input');

        if (Gate::allows('notAuthor', auth()->user())) {
            $data = Post::orderBy('id', 'DESC')->paginate(8);
        } else {
            $data = Post::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->paginate(4);
        }

        return view('post.posts', ['data' => $data]);
    }

    public function myPosts(){
        $data = Post::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->paginate(4);
        return view('post.posts', ['data' => $data]);
    }



    public function search(Request $request){


        $search_input = $request->input();
        if (empty($search_input['search_by'])) {
            $search_input = $request->session()->get('search_input');
            $request->session()->flash('search_input', $search_input);            
        }
        else {
            $request->session()->flash('search_input', $search_input);
        }

        $request->session()->flash('_old_input', $search_input);


        $search_by = $search_input['search_by'];
        $search = $search_input['search'];

        switch ($search_by) {
            case 'title':

                if (Gate::allows('notAuthor', auth()->user())) {
                    $data = Post::where($search_by,'LIKE', '%'. $search .'%')->paginate(4);
                }
                else {
                    $data = Post::where($search_by,'LIKE', '%'. $search .'%')->where('user_id',auth()->user()->id)->paginate(4);
                }                
                break;
            case 'category':

                if (Gate::allows('notAuthor', auth()->user())) {
                    $data = Post::whereRelation('category', 'category', 'LIKE',  $search . '%')->paginate(4);
                }else{
                    $data = Post::whereRelation('category', 'category', 'LIKE',  $search . '%')->where('user_id',auth()->user()->id)->paginate(4);
                }

                break;
            case 'user':
                if (Gate::allows('notAuthor', auth()->user())) {
                    $data = Post::whereRelation('user', 'name', 'LIKE',  $search . '%')->paginate(4);
                }else{
                    $data = Post::whereRelation('user', 'name', 'LIKE',  $search . '%')->where('user_id',auth()->user()->id)->paginate(4);
                }
                break;
        }
        return view('post.posts', ['data'=>$data]);
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        # not allowing user to move other page without pbulis or discart
        session()->flash('notAllow', true);
        
        # fetch the categories data
        $categories = Category::select('id', 'category')->get()->toArray();

        # return categories data to show in form for selection
        return view('post.createPost', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // $image = $request->img;
        $request->validate([
            'title' => 'required|string|max:55',
            'description' => 'required|string|min:400',
            'image' => 'required|mimes:jpeg,jpg,png|dimensions:max_width=1024,max_height=768',
            'category_id' =>  'required'
        ]);

        $post = POST::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'user_id' => auth()->user()->id,
        ]);

        $post->addMediaFromRequest('image')->toMediaCollection('posts');

        $this->removePreviewImages();

        return redirect()->route('posts')->with('message', 'New Post has published');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
            $post = POST::find($id);
            session()->flash('_old_input', $post);            


        # not allowing user to move other page without pbulis or discart
        session()->flash('notAllow', true);
        
        # fetch the categories data
        $categories = Category::select('id', 'category')->get()->toArray();

        # return categories data to show in form for selection
        return view('post.editPost', compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $request->validate([
            'title' => 'required|string|max:55',
            'description' => 'required|string|min:400',
            'image' => 'mimes:jpeg,jpg,png|dimensions:max_width=1024,max_height=768',
        ]);


        $post = POST::find($request->id);
        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);

        if ($request->hasFile('image')) {
            $post->clearMediaCollection('posts');
            $post->addMediaFromRequest('image')->toMediaCollection('posts');
        }
      

        $this->removePreviewImages();
        
        return redirect()->route('posts')->with('message', 'New Post has published');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        # use to remove single
        $post = Post::find($id)->delete();

        return redirect()->back()->with('message', 'Record has deleted successfully');
    }


    public function preview(Request $request)
    {
        $imageRequired = '';
        $route = route('post.create');
        $imageName;
        $imageUrl;

        if ($request->id == 0) {
            $imageRequired = 'required|';
        }else{
            $route = route('post.edit', ['id' => 0]);
            if ($request->hasFile('image')) {
                $imageRequired = 'required|';
            }
        }

        $validator = $request->validate([
            'title' => 'required|string|max:55',
            'description' => 'required|string|min:400',
            'image' => $imageRequired . 'image|mimes:jpg,png|dimensions:max_width=1024,max_height=768',
        ]);



        $post = $request->collect();
        $post->put('route', $route);

        if ($imageRequired ==  'required|') {
            $imageName = auth()->user()->id .'.'. $request->file('image')->extension();
            $request->file('image')->storeAs('previews/', $imageName, 'public');
            $post->put('imageName', $imageName);
        }
        else {
           $imgUrl =  POST::find($post['id'])->getFirstMedia('posts')->getUrl();
           $post->put('imageUrl', $imgUrl);
        }

        $request->flash();

        return view('Post.previewPost', compact('post'));
    }

    public function removePreviewImages()
    {
        $extensions = ['png', 'jpg', 'jpeg'];
        foreach ($extensions as $value) {
            $fileName =  auth()->user()->id.'.'.$value;
            if (Storage::disk('public')->exists('previews/'.$fileName)) {
                Storage::disk('public')->delete('/previews/'.$fileName);
            }
        }
    }

    public function discart()
    {
        $this->removePreviewImages();
        return redirect()->route('posts');
    }
}
