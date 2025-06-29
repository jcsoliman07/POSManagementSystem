<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class ProductsController extends Controller
{
    //

    public function index()
    {
        $products = Products::latest()->get();
        $categories = Category::get();
        return view('products.index', compact( 'products','categories'));
    }

    public function store(Request $request)
    {
        //Validate Data to Entry
        $validatedData = $request->validate([
            'product'           => ['required', 'string', 'max:255', 'unique:products,name'], //maps 'name' in prodcuts table name
            'price'             => ['required', 'numeric', 'min:0'],
            'category'          => ['required', 'exists:categories,id'], //Connected to the category_id in db
            'description'       => ['required', 'string'],
            'image'             => ['required', 'file', File::types(['png', 'jpg', 'jpeg'])],
        ]);

        //Store the uploaded image in 'storage/app/public/logos'
        $logopath = $request->file('image')->store('logos', 'public');

        //Create and stored validated data
        $product = Products::create([
            'category_id'       => $validatedData['category'], // Use validated data
            'name'              => $validatedData['product'], // Use validated data
            'description'       => $validatedData['description'], // Use validated data
            'price'             => $validatedData['price'], // Use validated data
            'image'             => $logopath, // Use validated data
        ]);

        //Displaying the HTTP - POST
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Product saved successfully!',
        //     'data'    => $product
        // ], 201); // 201 = Created
        
        return redirect('/products')->with('success', "Product added successfully!");
    }
}
