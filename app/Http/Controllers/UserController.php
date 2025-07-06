<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Products::latest()->get()->keyBy('id');
        $categories = Category::all();

        return view('user.index', compact('products', 'categories'));
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
        //Validate Data
        // dd($request->all());
        $request->validate([
            'orderData' => 'required|json',
        ]);

        //Decoding the json data
        $orderData = json_decode($request->orderData, true);

        $totalAmount = array_reduce($orderData, function ($carry, $item){
            return $carry + $item['subtotal'];
        }, 0);

        foreach ($orderData as $items) {
           dd([
                'orderData' => $orderData,
                'totalAmount' =>$totalAmount,
           ]);
        }
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

    }
}
