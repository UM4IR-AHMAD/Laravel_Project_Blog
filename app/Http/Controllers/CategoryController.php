<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Category::paginate(7);
        return view('categories', compact('data'));
    }

    public function search(Request $request){
        
        $data = Category::where('category', 'LIKE', $request->search . '%')->paginate(3);
        return view('categories')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'category' => 'required|unique:categories',
            'image' => 'required|mimes:jpeg,jpg,png|dimensions:max_width=800,max_height=600',
        ]);


        $category = Category::create([
            'category' => $request->category,
        ]);

        $category->addMediaFromRequest('image')->toMediaCollection('categories');


        return redirect()->route('categories')->with('message', 'Category has added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        //
        $data = Category::where('id', $id)->get();

  
        $array = (array) $data[0];

        $obj = $data[0];
        
     
        print_r ($obj);
        echo '</pre>';


        echo ($array->id);

    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {        
        $validator = Validator::make($request->all(), [
            'category' => ['required',  Rule::unique('categories')->ignore($request->id)],
            'image' => 'mimes:jpeg,jpg,png|dimensions:max_width=1024,max_height=786',

        ]);
       
     

        if ($validator->fails()) {
            return redirect()->route('categories')->withErrors($validator)->withInput()->with(['update-fail'=> 'Update'], ['action', 'http://127.0.0.1:8000/updateCategory']);
        
        }

        $category = Category::find($request->id);
        $category->category = $request->category;
        $category->save();    


        if ($request->hasFile('image')) {
            $category->clearMediaCollection('categories');
            $category->addMediaFromRequest('image')->toMediaCollection('categories');
        }


        return redirect()->route('categories')->with('message', 'updated success fully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->post()->delete();
        $cate = Category::find($id)->delete();
        return redirect()->route('categories')->with(['message' => 'Category has deleted']);
    }
}
