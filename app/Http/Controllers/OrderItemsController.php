<?php

namespace App\Http\Controllers;

use App\Models\OrderItems;
use App\Models\Orders;
use App\Services\DashboardStatsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderItemsController extends Controller
{
    //Declare a protected property to hold a instance of DashboardStatsService
    //This allows us to access the service methods through controller
    protected $dashboardStatsService;

    //This constructor automatically gives us access to the DashboardStatsService
    //We can use the methods im this controller
    public function __construct(DashboardStatsService $dashboardStatsService)
    {
        $this->dashboardStatsService = $dashboardStatsService;
    }

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

        $todayStats = $this->dashboardStatsService->getTodayStats();
        $yesterdayStats = $this->dashboardStatsService->getYesterdayStats();

        return view('order.index', 
                compact(
                    'orders',
                    'todayStats',
                    'yesterdayStats'
                ));
    }
}
