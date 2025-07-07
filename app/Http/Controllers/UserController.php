<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\OrderItems;
use App\Models\Orders;
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
        $request->validate([
            'orderData' => 'required|json',
        ]);

        //Decoding the json data
        $orderData = json_decode($request->orderData, true);

        $totalAmount = array_reduce($orderData, function ($carry, $item){
            return $carry + $item['subtotal'];
        }, 0);

        if(!is_array($orderData))
        {
            return back()->withErrors(['orderData' => 'Invalid Order Data Recieved!']);
        }
        
        //Create and Store Data to Order Table
        $order = Orders::create([
            'user_id' => 3, //Temporarily Harcoded the User ID, soon it will be based on the login user
            'total_amount' => $totalAmount, //Total Amount of the orders
        ]);

        //Create and Store Data for Order Items
        foreach ($orderData as $item) {
            
            // dd([
            //         'orderData' => $orderData, //Fetch data for each item
            //         'totalAmount' =>$totalAmount, //Total Amount of price for all item
            // ]);
            OrderItems::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['subtotal'],
            ]);

        }

        return redirect()->back()->with('success', 'Order Successfully placed!');
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
