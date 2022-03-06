<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon; 
use DB;

use App\Charts\UserChart;
use App\Charts\OrderChart;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;

//use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class AdminHome extends Component
{
    //use LivewireAlert;
    public function render()
    {
        $borderColors = [
            "rgba(255, 99, 132, 1.0)",
            "rgba(22,160,133, 1.0)",
            "rgba(255, 205, 86, 1.0)",
            "rgba(51,105,232, 1.0)",
            "rgba(244,67,54, 1.0)",
            "rgba(34,198,246, 1.0)",
            "rgba(153, 102, 255, 1.0)",
            "rgba(255, 159, 64, 1.0)",
            "rgba(233,30,99, 1.0)",
            "rgba(205,220,57, 1.0)"
        ];
        $fillColors = [
            "rgba(255, 99, 132, 0.2)",
            "rgba(22,160,133, 0.2)",
            "rgba(255, 205, 86, 0.2)",
            "rgba(51,105,232, 0.2)",
            "rgba(244,67,54, 0.2)",
            "rgba(34,198,246, 0.2)",
            "rgba(153, 102, 255, 0.2)",
            "rgba(255, 159, 64, 0.2)",
            "rgba(233,30,99, 0.2)",
            "rgba(205,220,57, 0.2)"

        ];

        $topProducts = OrderProduct::select("product_id", DB::raw("sum((quantity) * price) as product_total"),
        DB::raw("sum(quantity) as product_qty"))
                        ->groupBy('product_id')
                        ->orderBy('product_qty', 'DESC')
                        ->take(5)
                        ->get();
        
        

        // Total Sales
        $revcountToday = Order::whereDate('created_at', today());
        $order = $revcountToday;
        $revcountToday = $revcountToday->sum('total');
        $trevcountYesterday = Order::sum('total');
        $this->trev_current_count = $trevcountYesterday;
        $trevcountYesterday = $trevcountYesterday - $revcountToday;
        $this->rev_percent_change = ($revcountToday/$trevcountYesterday)*100;

        $userCount = User::role('customer')
        ->whereDate('created_at', today())
        ->count();
        
        // Registered Users
        $userCountYesterday = User::role('customer')->count();
        $this->user_current_count = $userCountYesterday;
        $userCountYesterday = $userCountYesterday - $userCount;
        $this->user_percent_change = ($userCount/$userCountYesterday)*100;

        // Orders
        $orderCountToday = $order->count();
        $this->totalOrders = Order::count();
        $ordersYesterday = $this->totalOrders - $order->count();
        $this->order_percent_change = ($orderCountToday/$ordersYesterday)*100;

        // Total Revenue (Last 7 days) Chart
        $data = collect([]);
        $data0 = collect([]);
        for ($days_backwards = 6; $days_backwards >= 0; $days_backwards--) {
            // Could also be an array_push if using an array rather than a collection.
            $data0->push(Carbon::today()->subDays($days_backwards)->isoFormat('MM-D-YYYY'));
            $data->push(Order::whereDate('created_at', today()->subDays($days_backwards))->sum('total'));
        }
        $orderchart = new OrderChart;
        $orderchart->labels($data0);
        $orderchart->dataset('Revenue (in PHP)', 'bar', $data)
            ->backgroundColor('green');

        // Registered Users (Last 3 days)
        $today_users = User::whereDate('created_at', today())->count();
        $yesterday_users = User::whereDate('created_at', today()->subDays(1))->count();
        $users_2_days_ago = User::whereDate('created_at', today()->subDays(2))->count();
        $userchart = new UserChart;
        $userchart->labels(['2 days ago', 'Yesterday', 'Today']);
        $userchart->dataset('User', 'line', [$users_2_days_ago, $yesterday_users, $today_users])
        ->backgroundColor('purple');


        //s$topProductsx = OrderProduct::
        $dataxc = OrderProduct::with('product')->groupBy('product_id')
            ->get()
            ->map(function ( $item ) {
                return (object)[
                    'orderTotal' => $item->price * $item->quantity,
                    
                ];
            });
        $chart = new OrderChart;
        $chart->labels(['One', 'Two', 'Three', 'Four']);
        $chart->dataset('My dataset', 'pie', [1,2,3,4])
            ->color($borderColors)
            ->backgroundcolor($fillColors);


        //dd($topProducts);

        return view('livewire.admin.admin-home', compact('chart','orderchart', 'userchart', 'topProducts'))->layout('layouts.admin');
    }
}
