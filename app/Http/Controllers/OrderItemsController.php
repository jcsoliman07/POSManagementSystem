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

        $todayStats = $this->dashboardStatsService->getTodayStats();
        $yesterdayStats = $this->dashboardStatsService->getYesterdayStats();
        $RevenueDifferencePercentage = $this->dashboardStatsService->getRevenueDifferencePercentage();
        $OrderDifferencePercentage = $this->dashboardStatsService->getOrderDifferencePercentage();
        $OrderItemDifferencePercentage = $this->dashboardStatsService->getOrderItemDiferencePercentage();

        return view('order.index', 
                compact(
                    'orders',
                    'todayStats',
                    'yesterdayStats',
                    'RevenueDifferencePercentage',
                    'OrderDifferencePercentage',
                    'OrderItemDifferencePercentage'
                ));
    }
}
