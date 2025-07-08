<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashBoardController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();

        $todayStats = Orders::selectRaw('COUNT(*) as order_count, SUM(total_amount) as revenue')
                ->whereDate('created_at', today()) //Filter using date today
                ->first();

        return view('components.dashboard', [
            'user' => $user,
            'todayOrders' => $todayStats->order_count?? 0,
            'todayRevenue' => $todayStats->revenue ?? 0,
        ]);
    }
}
