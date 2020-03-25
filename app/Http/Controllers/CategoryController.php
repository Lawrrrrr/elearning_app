<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = auth()->user()->unOwnedCategories()->paginate(6);
        
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        if(auth()->user()->isAdmin())
            return view('categories.create');
        else
            return redirect()->route('home');
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->isAdmin()) {
            $request->validate([
                "title" => "required|min:2",
                "description" =>"required|min:10"
            ]);
    
            Category::create([
                "user_id" => auth()->user()->id,
                "title" => $request->title,
                "description" => $request->description,
                "is_complete" => false
            ]); 
        }

        return redirect()->route('categories.admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoryOwner = auth()->user()->id;
        $category = Category::find($id);
        if(!empty($category)){
            if($categoryOwner == $category->user_id)
                return view('categories.edit', compact('category'));
            else
                return redirect()->route('home');
        }
        return redirect()->route('home');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $category = Category::find($id);

        $request->validate([
            "title" => "required|min:2",
            "description" =>"required|min:10"
        ]);

        $category->update([
            "title" => $request->title,
            "description" => $request->description,
        ]);
        
        return redirect()->route('categories.admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id)->delete();

        return redirect()->route('categories.admin');
    }

    public function ownerCategoriesList()
    {
        $categories = auth()->user()->categories()->get();
        
        return view('categories.admin', compact('categories'));
    }
}
