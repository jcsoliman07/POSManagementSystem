<?php

namespace App\Http\Controllers;

use App\Models\OrderItems;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderItemsController extends Controller
{
    //
    public function index()
    {
        $orders = Orders::with([
                'user:id,name', //The user for each Order
                'items:id,order_id,product_id,quantity',
                'items.product:id,category_id,name,price',
                'items.product.category:id,name' //The items for each order, the product for each item, the category for each product
            ])
            ->paginate(10);
        
        // return response()->json($orders);
        return view('order.index', compact('orders'));
    }
}
