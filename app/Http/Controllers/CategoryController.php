<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'category' => ['required', 'string', 'max:255', 'unique:categories,name'], // Added unique rule
        ]);

        // Create a new Category instance
        Category::create([
            'name' => $validatedData['category'], // Use validated data
        ]);

        // Redirect back with a success message
        return redirect('/category')->with('success', "Category added successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        // $category = Category::findOrFail($id); // Find the category or throw 404
        // return view('category.show', compact('category')); // Assuming category.show blade file
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
    public function update(Request $request, Category $category) //Route Binding
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'category' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'name')->ignore($category->id),
            ],
        ]);
        
        // Update the category name
        $category->update([
            'name' => $validatedData['category'],
        ]);
        
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Category updated!');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category) //Route Binding
    {
        //
        $category->delete();

        return redirect()->back()->with('warning', 'Category deleted successfully!');
    }
}
