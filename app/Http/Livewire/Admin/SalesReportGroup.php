<?php

namespace App\Http\Livewire\Admin;

use App\Models\{Order, OrderProduct};
use Carbon\Carbon;
use DB;
use Livewire\Component;
use Session;

class SalesReportGroup extends Component
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
        //$orders = Order::select("order_product.*", DB::raw("(sum(total)) as total_order"), DB::raw("(DATE_FORMAT(created_at, '%m-%Y')) as month_year"));
        $cart = OrderProduct::select("order_product.*", DB::raw("sum(quantity) as product_qty"))
        ->groupBy('order_product.order_id', 'order_product.product_id')
        
        ->get();
        dd($cart);

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
                    $orders = $orders
                    //->whereMonth('created_at', '>=', $this->month_from)
                    ->whereDate('created_at', '>=', $this->year_from.'-'.$this->month_from)
                    ->whereDate('created_at', '<=', $this->year_to.'-'.$this->month_to);
                    //date('m')
                //$q->whereYear('created_at', '=', date('Y'));
                    
                break;
 
            case('year'):
                    dd('i selected year');
            
                break;
            default:
                //Leave blank as of now
            }
        if($this->group_by == 'date'){
            $orders->groupBy(DB::raw("DATE(created_at)"));
        }  
        if($this->group_by == 'month'){
            $orders->groupBy(DB::raw("MONTH(created_at)"));
        }
        if($this->group_by == 'year'){
            $orders->groupBy(DB::raw("YEAR(created_at)"));
        } 
           // whereDate('created_at', '=', $this->date) 
          //  ->where('status', '!=', 'cancelled') 
            //->paginate(10);
        $orders = $orders->paginate(10);
        //dd($orders);

        return view('livewire.admin.sales-report-group', compact('orders'))->layout('layouts.admin');
    }
}
