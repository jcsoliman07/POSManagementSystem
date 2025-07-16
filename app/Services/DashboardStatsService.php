<?php

namespace App\Services;

use Illuminate\Container\Attributes\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log as FacadesLog;

class DashboardStatsService{

    protected function getStatsBetween($startDate, $endDate)
    {   
        //Split the Query to avoid Duplication
        //Orders Count and Revenue
        $orderStats = DB::table('orders')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('COUNT(id) as order_count, SUM(total_amount) as revenue')
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
        ];
    }

    //Get todays statistics
    public function getTodayStats()
    {
        $start = now('Asia/Manila')->startOfDay();
        $end = now('Asia/Manila')->endOfDay();
        return $this -> getStatsBetween($start, $end);
    }

    // //Get yesterdays statistics
    // public function getYesterdayStats()
    // {
    //     $yesterday = now()->subDay();
    //     return $this->getStatsBetween($yesterday->startOfDay(),$yesterday->endOfDay());
    // }

}
