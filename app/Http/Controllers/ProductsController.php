<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class ProductsController extends Controller
{
    //

    public function index()
    {
        $products = Products::with('category')->latest()->paginate(10); //Add pagination and eager load category
        $categories = Category::all();
        // return ProductResource::collection($products); //Return a collection of resources

        return view('products.index', compact( 'products','categories'));
    }

    public function store(StoreProductRequest $request)
    {
        //Validate Data to Entry
        $validatedData = $request->validated(); //Data is already validated

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


    public function update(Request $request, Products $product)
    {   
        // //Checking if the route is connected and request is processed
        // dd($request->all());

        // Validate Data Entry
        $validatedData = $request->validate([
            'product'           => ['required', 'string', 'max:255', Rule::unique('products', 'name')->ignore($product->id)], //Rule::unique()->ignore() prevents the validation from failing to keep the same product
            'price'             => ['required', 'numeric', 'min:0'],
            'category'          => ['required', 'exists:categories,id'], //Connected to the category_id in db
            'description'       => ['required', 'string'],
            'image'             => ['nullable', 'file', File::types(['png', 'jpg', 'jpeg'])], //Nullable if uploading new image is optional, and keeping the old image
            'existing_image'    => ['nullable', 'string'],
        ]);

        //Check if a new Image was uploaded
        if($request->hasFile('image')){

            //Delete old image if stored
            if($product->image && Storage::disk('public')->exists($product->image)){
                Storage::disk('public')->delete($product->image);
            }

            $filename = $request->file('image')->store('logos', 'public');
            $validatedData['image'] = $filename;

        } else {
            // No new image uploaded — keep the old one
            $validatedData['image'] = $validatedData['existing_image'] ?? $product->image;
        }

        //Update the Product Data
        $product->update([
            'category_id' => $validatedData['category'],
            'name'        => $validatedData['product'],
            'description' => $validatedData['description'],
            'price'       => $validatedData['price'],
            'image'       => $validatedData['image'],
        ]);

        // //Displaying the HTTP - POST - UPDATE
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Product updated!',
        //     'data'    => $product
        // ], 200); // 200 = Ok

        return redirect('/products')->with('success', "Product updated!");
    }

    public function destroy(Request $request, Products $product)
    {

    }
}
