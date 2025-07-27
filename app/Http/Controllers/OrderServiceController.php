<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Category;
use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderServiceController extends Controller
{
    //
    public function index()
    {
        //
        $products = Products::latest()->get()->keyBy('id');
        $categories = Category::all();

        return view('user.index', compact('products', 'categories'));

    }

    public function store(StoreOrderRequest $request)
    {

        $orderData = json_decode($request->orderData, true);

        if(!is_array($orderData))
        {
            return back()->withErrors(['orderData' => 'Invalid Order Data Recieved!']);
        }
        
        DB::beginTransaction();

        try{

            //Create and Store Data to Order Table
            $order = Orders::create([
                'user_id' => Auth::id(), //Use the Authenticated Login User ID
                'customer' => $request->customerName,
                'payment_method' => $request->paymentMethod,
                'total_amount'  => 0, //Temporary placeholder
            ]);

            $totalAmount = 0; //Preparing Total Amount of Order

            //Create and Store Data for Order Items
            foreach ($orderData as $item) {

                OrderItems::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['subtotal'],
                ]);

                $totalAmount += $item['subtotal']; //Get the sum price of product in order
            }

            $order->update([
                'total_amount' => $totalAmount,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Order Successfully placed!');

        }catch (\Exception $e){

            DB::rollBack();

            return redirect()->back()->with('error', 'Something went wrong. Please try again!');
        }

    }
}
