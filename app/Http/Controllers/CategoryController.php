<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Category::withCount('products')->latest()->get();

        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        // return view('category.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate
        request()->validate([
            'category' => ['required', 'string', 'max:255'],
        ]);

        //store
        Category::create([
            'name' => request()->input('category'),
        ]);

        //redirect
        return redirect('/category')->with('success', "Category added successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
        // Dump to verify if request is hitting
        // logger('Update hit');
        // dd($request->all());

        //validate
        $request->validate([
        'category' => 'required|string|max:255',
        ]);
        
        //store
        $category->update([
            'name' => $request->category,
        ]);

        //redirect
        return redirect()->back()->with('success', 'Category updated!');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully!');
    }
}
