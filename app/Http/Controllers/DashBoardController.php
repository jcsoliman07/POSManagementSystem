<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Services\DashboardStatsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashBoardController extends Controller
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

        $user = Auth::user();

        // $todayStats = Orders::selectRaw('COUNT(*) as order_count, SUM(total_amount) as revenue')
        //         ->whereDate('created_at', today()) //Filter using date today
        //         ->first();

        $todayStats = $this->dashboardStatsService->getTodayStats();

        return view('components.dashboard', compact('user', 'todayStats'));
    }
}
