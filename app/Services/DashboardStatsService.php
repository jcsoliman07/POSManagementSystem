<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DashboardStatsService{

    protected function getStatsBetween($startDate, $endDate)
    {

        return DB::table('orders')
                ->join('order_items', 'orders.id', '=' , 'order_items.order_id' )
                ->selectRaw('
                    COUNT(DISTINCT orders.id) as order_count,
                    SUM(orders.total_amount) as revenue,
                    SUM(order_items.quantity) as total_items_sold
                
                ')
                ->whereDate('orders.created_at', [$startDate,$endDate])
                ->first();
    }

    //Get todays statistics
    public function getTodayStats()
    {
        return $this->getStatsBetween(now()->startOfDay(),now()->endOfDay());
    }

}
