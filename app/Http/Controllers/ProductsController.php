<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class ProductsController extends Controller
{
    //
    private const IMAGE_FOLDER = 'logos';
    private const DISK = 'public';

    private function handleImageUpload(Request $request, ?Products $product = null): ?string
    {
        if  ($request->hasFile('image'))
        {
            if  ($product && $product->image && Storage::disk(self::DISK)->exists($product->image))
            {
                Storage::disk(self::DISK)->delete($product->image);
            }
            return $request->file('image')->store(self::IMAGE_FOLDER, self::DISK);
        }

        return $request->input('existing_image') ?? ($product->image ?? null);
    }

    public function index()
    {
        $products = Products::with('category')->latest()->paginate(10); //Add pagination and eager load category
        $categories = Category::all();

        return view('products.index', compact( 'products','categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $validatedData = $request->validated();

        //Store the uploaded image in 'storage/app/public/logos'
        $validatedData['image'] = $this->handleImageUpload($request);

        //Create and stored validated data
        $product = Products::create([
            'category_id'       => $validatedData['category'], // Use validated data
            'name'              => $validatedData['product'], // Use validated data
            'description'       => $validatedData['description'], // Use validated data
            'price'             => $validatedData['price'], // Use validated data
            'image'             => $validatedData['image'], // Use validated data
        ]);
        
        return redirect('/products')->with('success', "Product added successfully!");
    }


    public function update(UpdateProductRequest $request, Products $product)
    {   
        $validatedData = $request->validated();
    
        $validatedData['image'] = $this->handleImageUpload($request, $product);
        
        $product->update([
            'name'        => $validatedData['product'],
            'price'       => $validatedData['price'],
            'category_id' => $validatedData['category'],
            'description' => $validatedData['description'],
            'image'       => $validatedData['image'],
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');

    }

    public function destroy(Request $request, Products $product)
    {

    }
}
