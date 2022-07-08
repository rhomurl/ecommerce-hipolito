<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Carbon\Carbon;
use DB;
use Livewire\Component;
use Session;

class SalesReport extends Component
{
    public $selected_filter, $group_by;
    public $month_from, $month_to, $year_from, $year_to;
    public $date_from, $date_to;

    public function mount(){
        
        $data = session()->get('data');
        if(session()->has('data')){    
            $this->selected_filter = $data['selected_filter'];
            $this->group_by = $data['group_by'];

            // For Month and Year
            $this->month_from = $data['month_from'];
            $this->month_to = $data['month_to'];
            $this->year_from = $data['year_from'];
            $this->year_to = $data['year_to'];

            $this->date_from = $data['date_from'];
            $this->date_to = $data['date_to'];
            
        }
    }

    public function redirectTo($route){
        return redirect()->route($route);
    }

    public function render()
    {
        $orders = Order::query();

        switch($this->selected_filter) {
            case('date'):

                if($this->date_from && $this->date_to){
                    $orders = $orders->whereDate('created_at', '>=', $this->date_from)
                    ->whereDate('created_at', '<=', $this->date_to);
                }
                else if($this->date_from){
                    $orders = $orders->whereDate('created_at', '=', $this->date_from);

                }
                break;
 
            case('month'):

                if($this->month_from && $this->year_from && $this->year_to && $this->year_from)
                {
                    $orders = $orders
                    ->whereDate('created_at', '>=', date($this->year_from.'-'.$this->month_from.'-01').' 00:00:00')
                    ->whereDate('created_at', '<=', date($this->year_to.'-'.$this->month_to.'-31').' 23:59:59');
                }
                else if($this->month_from && $this->year_from){
                    $orders = $orders
                    //->whereMonth('created_at', '>=', $this->month_from)
                    ->whereDate('created_at', '>=', date($this->year_from.'-'.$this->month_from.'-01').' 00:00:00')
                    ->whereDate('created_at', '<=', date($this->year_from.'-'.$this->month_from.'-31').' 23:59:59');
                }
                   
                    //date('m')
                //$q->whereYear('created_at', '=', date('Y'));
                    
                break;
 
            case('year'):

                if($this->year_from && $this->year_to)
                {
                    $orders = $orders
                        ->whereYear('created_at', '>=', date($this->year_from))
                        ->whereYear('created_at', '<=', date($this->year_to));
                }
                else if($this->year_from)
                {
                    $orders = $orders
                    ->whereYear('created_at', '=', date($this->year_from));
                }
                   
                break;
            default:
               
            }

        $orders = $orders
            ->where('status', '!=', 'cancelled')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('livewire.admin.sales-report', compact('orders'))->layout('layouts.admin');
    }
}
/*
$q->whereDay('created_at', '=', date('d'));
$q->whereMonth('created_at', '=', date('m'));
$q->whereYear('created_at', '=', date('Y'));
**./


/*$order = Order::query();

        $product = Order::query()->with('orderProduct');

        $product_today = $product
            ->where('status','ordered')
            ->where('created_at', '>=', now()->subDays(7))
            ->get();
            
            $this->totalc = $product_today->count();
            $this->sumc = $product_today->sum('total');

        $product_today = $product_today->groupBy(function($item) {
            return $item->created_at->format('d');
       });*/
       

        //dd($product_today);

        //$this->week = $order->where('status','ordered')->where('created_at', '>=', Carbon::now()->subDays(7))->sum('total');

        //$this->month = $order->where('status','ordered')->whereMonth('created_at', '=', date('m'))->sum('total');

        //$this->total = $order->where('status','ordered')->sum('total');