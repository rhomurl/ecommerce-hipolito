<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon; 
use DB;
use App\Traits\ModelComponentTrait;
use App\Charts\{UserChart, OrderChart};
use App\Models\{ActivityLog, Order, OrderProduct, Product, ProductInventory, User};
use App\Services\OrderService;
//use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class AdminHome extends Component
{
    use ModelComponentTrait;
    //use LivewireAlert;

    /*
        For improvement
        ? : Make the codes short as possible
        ! : Check for duplicate queries
    */

    public function mount(){
        $this->otw = resolve(OrderService::class)->displayOrders('otw', 'display')->get();
        $this->ordered = resolve(OrderService::class)->displayOrders('ordered', 'display')->get();
        $this->process = resolve(OrderService::class)->displayOrders('processing', 'display')->get();
        $this->completed = resolve(OrderService::class)->displayOrders('delivered', 'display')->get();
        
        $this->recent_orders = Order::with('user')->limit(10)->latest()->get();
        $this->activity_log = ActivityLog::limit(10)->latest()->get();

        $this->low_inventory = ProductInventory::where('status', 'REORDER')->limit(5)->get();
        $this->low_inventory_count = ProductInventory::where('status', 'REORDER')->count();
    }

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
        $order = Order::query();
        $revcountTotal = $order->sum('total');
        $revcountToday = $order->whereDate('created_at', today())->sum('total');
        //$order = $revcountToday;
        
        $this->trev_current_count = $revcountTotal;
        $trevcountYesterday = $revcountTotal - $revcountToday;
        if($revcountTotal == 0 || $trevcountYesterday == 0){
            $this->rev_percent_change = 0;
        }
        else{
            $this->rev_percent_change = ($revcountToday/$trevcountYesterday)*100;
        }

        $userToday = User::role('customer')
            ->whereDate('created_at', today())
            ->count();
        
        // Registered Users
        $userTotal = User::role('customer')->count();
        $this->user_current_count = $userTotal;
        $userYesterday = $userTotal - $userToday;

        if($userTotal == 0 || $userYesterday == 0){
            $this->user_percent_change = 0;
        }
        else{
            $this->user_percent_change = ($userToday/$userYesterday)*100;
        }
        // Orders
        $orderCountToday = $order->count();
        $this->totalOrders = Order::count();
        $ordersYesterday = $this->totalOrders - $order->count();
        if($orderCountToday == 0 || $ordersYesterday == 0)
        {
            $this->order_percent_change = 0;
        }
        else{
            $this->order_percent_change = ($orderCountToday/$ordersYesterday)*100;
        }
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

        $this->registered_products = Product::all();
        //s$topProductsx = OrderProduct::
       /* $dataxc = OrderProduct::with('product')->groupBy('product_id')
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

*/
        //dd($topProducts);

        return view('livewire.admin.admin-home', compact('orderchart', 'userchart', 'topProducts'))->layout('layouts.admin');
    }
}
