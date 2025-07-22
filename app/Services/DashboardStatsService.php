<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class DashboardStatsService{

    protected function getStatsBetween($startDate, $endDate)
    {   
        //Split the Query to avoid Duplication
        //Orders Count and Revenue
        $orderStats = DB::table('orders')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('COUNT(id) as order_count, SUM(total_amount) as revenue, COUNT(DISTINCT customer) as customer_count')
            ->first();

        //Total Items Sold
        $totalItemsSold = DB::table('order_items')
            ->join('orders' , 'order_items.order_id', '=' , 'orders.id')
            ->whereBetween('orders.created_at', [$startDate, $endDate])
            ->selectRaw('SUM(order_items.quantity) as total_items_sold')
            ->value('total_items_sold');
        
        return (object)[
            'order_count'       => $orderStats->order_count ?? 0,
            'total_amount'      => $orderStats->revenue ?? 0,
            'total_items_sold'  => $totalItemsSold->total_items_sold ?? 0,
            'customer_count'    => $orderStats->customer_count ?? 0,
        ];
    }

    //Get todays statistics
    public function getTodayStats()
    {
         $start = now('Asia/Manila')->startOfDay();
        $end = now('Asia/Manila')->endOfDay();
        return $this -> getStatsBetween($start, $end);
    }

    //Get yesterdays statistics
    public function getYesterdayStats()
    {
        $yesterdayStart = now('Asia/Manila')->startOfDay()->subDay(); //subDay substract 1 day from the current time
        $yesterdayend = now('Asia/Manila')->endOfDay()->subDay();

        Log::info("Yesterday Start: $yesterdayStart");
        Log::info("Yesterday End: $yesterdayend");

        return $this->getStatsBetween($yesterdayStart, $yesterdayend);
    }

    public function getRevenueDifferencePercentage()
    {
        //Get Todays Revenue
        $todayStats = $this->getTodayStats();
        $todayRevenue = $todayStats->total_amount ?? 0;

        //Get Yesterdays Revenue
        $yesterdayStat = $this->getYesterdayStats();
        $yesterdayRevenue = $yesterdayStat->total_amount ?? 0;

        Log::info("Todays Revenue: $todayRevenue");
        Log::info("Yesterday Revenue: $yesterdayRevenue");

        //Avoid diving to zero
        if ($yesterdayRevenue == 0) { //If Yesrteday Revenue is 0 
            return $todayRevenue == 0 ? 0 : 100; //Then if Today Revenue is 0 no change, if Today Revenue > 0 display 100%
        }

        //Calculate the percentage
        //To get Percentage value, we divide the dividend to divisor and then multiple to 100 (max percent)
        //RevenuePercentage - how much revenue has increased or decreased compared to yesterday
        //To get we need first subtract today to yesterday, divide to testerday and then multiply by 100
        $RevenuePercentage = (($todayRevenue - $yesterdayRevenue) / $yesterdayRevenue) * 100;

        return round($RevenuePercentage, 2); //Round to 2 deceimal places

    }

}
