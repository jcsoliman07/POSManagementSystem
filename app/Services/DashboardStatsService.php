<?php

namespace App\Services;

use App\Models\OrderItems;
use App\Models\Orders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class DashboardStatsService{

    public function getDashboardData()
    {
        return[
            'todayStats'                       =>  $this->getTodayStats(),
            'yesterdayStats'                   =>  $this->getYesterdayStats(),
            'RevenueDifferencePercentage'      =>  $this->getRevenueDifferencePercentage(),
            'OrderDifferencePercentage'        =>  $this->getOrderDifferencePercentage(),
            'OrderItemDifferencePercentage'    =>  $this->getOrderItemDiferencePercentage(),
            'CustomerDifferencePercentage'     =>  $this->getCustomerDiferencePercentage(),
            'weekSalesChart'                   =>  $this->getWeeklySalesChart(),
            'paymentChart'                     =>  $this->getPaymentMethodChart(),
            'TopSelling'                       =>  $this->getTopFivesellingProducts(),
            'AllOrdersTransaction'             =>  $this->getAllOrdersTransaction(),
            'RecentOrdersTransaction'          =>  $this->getRecentOrdersTransaction(),
        ];
    }


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
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $weeklySales = DB::table('orders')
                        ->selectRaw('DATE(created_at) as date, COUNT(id) as order_count, SUM(total_amount) as revenue, COUNT(DISTINCT customer) as customer_count')
                        ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                        ->groupBy(DB::raw('DATE(created_at)'))
                        ->get()
                        ->keyBy('date');

        Log::info("Start of the Week: $startOfWeek");
        Log::info("Start of the Week: $endOfWeek");

        $salesChart = []; //Initialize and array to hold value: 7 days
        $date = $startOfWeek->copy(); //Create a copy of Start Date of the week

        while ($date->lte($endOfWeek)) { //Loop to get the start and end date of the week

            $formattedDate = $date->toDateString(); //Format Date into string in 'YYYY-MM-DD'
            $salesData = $weeklySales->get($formattedDate);

            $salesChart[] = [
                'date'              =>  $formattedDate,
                'order_count'       =>  $salesData->order_count ?? 0,
                'revenue'           =>  $salesData->revenue ?? 0,
                'customer_count'    =>  $salesData->customer_count ??0,
            ];

            $date->addDay();
        }
        
        return $salesChart;
    }
    
    public function getWeeklySalesChart()
    {
        return $this->getSalesChart(); //Calling getSalesChart Method
    }


    //Payment Method
    protected function getPaymentMethod()
    {
        $paymentMethod = DB::table('orders')
                            ->select('payment_method', DB::raw('COUNT(*) as countPaymentMethod'))
                            ->groupBy('payment_method')
                            ->pluck('countPaymentMethod', 'payment_method');
        
        $paymentName  = [
            'C' => 'Cash',
            'E' => 'E-Money',
        ];

        $labels = $paymentMethod->keys()->map(function($key) use ($paymentName){
            return $paymentName[$key] ?? $key;
        });
        
        $paymentChart = [
            'labels'    =>      $labels,
            'data'      =>      $paymentMethod->values(),
        ];

        return $paymentChart;

    }

    public function getPaymentMethodChart()
    {
        return $this->getPaymentMethod();
    }


    //All Time Top Products
    protected function getTopSellingProducts()
    {

        $itemsStats = DB::table('order_items')
                ->join('products', 'order_items.product_id', '=', 'products.id')
                ->selectRaw('products.name as product, SUM(order_items.quantity) as total_product_quantity')
                ->groupBy('products.id', 'products.name')
                ->orderByDesc('total_product_quantity');

        return $itemsStats;
    }

    public function getTopFivesellingProducts()
    {
        return $this->getTopSellingProducts()
                ->limit(5)
                ->get();
    }


    //Orders Transactions
    protected function getOrdersTransaction()
    {
        $orders = Orders::with([
                'user:id,name',
                'items:id,order_id,product_id,quantity',
                'items.product:id,category_id,name,price',
                'items.product.category:id,name'
        ])->latest();

        return $orders;
    }

    //All Transactions
    public function getAllOrdersTransaction()
    {
        return $this->getOrdersTransaction()
            ->paginate(10);
    }

    //Recent Transactions
    public function getRecentOrdersTransaction()
    {
        return $this->getOrdersTransaction()
            ->paginate(5);
    }
}
