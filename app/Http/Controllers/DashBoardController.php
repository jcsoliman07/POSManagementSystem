<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashBoardController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();

        // $todayStats = Orders::selectRaw('COUNT(*) as order_count, SUM(total_amount) as revenue')
        //         ->whereDate('created_at', today()) //Filter using date today
        //         ->first();

        $todayStats = DB::table('orders')
                ->join('order_items', 'orders.id', '=' , 'order_items.order_id' )
                ->selectRaw('
                    COUNT(DISTINCT orders.id) as order_count,
                    SUM(orders.total_amount) as revenue,
                    SUM(order_items.quantity) as total_items_sold
                
                ')
                ->whereDate('orders.created_at', today())
                ->first();

        return view('components.dashboard', compact('user', 'todayStats'));
    }
}
