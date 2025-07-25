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
            ->sum('order_items.quantity'); //Optimize from selectRaw then value to a SUM method
        
        return (object)[
            'order_count'       => $orderStats->order_count ?? 0,
            'total_amount'      => $orderStats->revenue ?? 0,
            'total_items_sold'  => $totalItemsSold ?? 0,
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
        //Use the function calculatePercentageDifference
        return $this->calculatePercentageDifference(
            $this->getYesterdayStats()->total_amount ?? 0,
            $this->getTodayStats()->total_amount ?? 0,
            'Revenue'
        );

    }

    public function getOrderDifferencePercentage()
    {
        //Use the function calculatePercentageDifference
        return $this->calculatePercentageDifference(
                $this->getYesterdayStats()->order_count ?? 0,
                $this->getTodayStats()->order_count ?? 0,
                'Order'
        );
    }

    public function getOrderItemDiferencePercentage()
    {
        //Use function calculatePercentageDifference
        return $this->calculatePercentageDifference(
            $this->getYesterdayStats()->total_items_sold,
            $this->getTodayStats()->total_items_sold,
            'Order Items'
        );
    }

    public function getCustomerDiferencePercentage()
    {
        //Use function calculatePercentageDifference
        return $this->calculatePercentageDifference(
            $this->getYesterdayStats()->customer_count,
            $this->getTodayStats()->customer_count,
            'Customer'
        );
    }

    //Reusable Calculation of Percentage
    protected function calculatePercentageDifference($yesterdayValue, $todayValue, $label = 'Value')
    {
        Log::info("Todays $label : $todayValue");
        Log::info("Yesterday $label : $yesterdayValue");

        //Avoid dividing to zero
        if ($yesterdayValue == 0) {
            return $todayValue == 0 ? 0: 100;
        }
        
        //Calculate Difference Percentage
        //To get Percentage value, we divide the dividend to divisor and then multiple to 100 (max percent)
        //How much order has increased or decreased compared to yesterday
        //To get we need first subtract today to yesterday, divide to testerday and then multiply by 100
        $differencePercentage = (($todayValue - $yesterdayValue) / $yesterdayValue) * 100;

        return round($differencePercentage, 2);
    }

    //Sales Chart for week
    protected function getSalesChart()
    {
        
    }

}
