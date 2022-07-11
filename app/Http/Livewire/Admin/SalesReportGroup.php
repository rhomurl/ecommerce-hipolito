<?php

namespace App\Http\Livewire\Admin;

use App\Models\{Order, OrderProduct};
use Carbon\Carbon;
use DB;
use Livewire\Component;
use PDF;
use Session;

class SalesReportGroup extends Component
{
    public $selected_filter, $group_by;
    public $month_from, $month_to, $year_from, $year_to;
    public $date_from, $date_to, $genOrders, $range;

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

    public function generatePDF(){
        switch($this->selected_filter) {
            case('date'):

                if($this->date_from && $this->date_to){
                   $range = $this->date_from . "_to_" . $this->date_to;
                }
                else if($this->date_from){
                    $range = $this->date_from;
                }
                break;
 
            case('month'):

                if($this->month_from && $this->year_from && $this->year_to && $this->year_from)
                {
                    $range = $this->month_from . "_" . $this->year_from . "_to_" . $this->month_to . "_" . $this->year_to;
                }
                else if($this->month_from && $this->year_from){
                    $range = $this->month_from . "_" . $this->year_from;
                }
                
                break;
 
            case('year'):

                if($this->year_from && $this->year_to)
                {
                    $range = $this->year_from . "_to_" . $this->year_to;
                }
                else if($this->year_from)
                {
                    $range = $this->year_from; 
                }
                   
                break;
            default:
                $range = "all";
        }

        $data = [
            'genOrders' => $this->genOrders,
            'generatedAt' => Carbon::now()->format('M d Y h:i A'),
            'range' => $range,
            'group_by' => $this->group_by
        ];

        //dd($data);
        //$pdf = PDF::loadView('pdf.sales-report', $data);
        //return $pdf->download('sales-report_.pdf');
        //return $pdf->stream();

        $pdfContent = PDF::loadView('pdf.sales-report-group', $data)->output();
        return response()->streamDownload(
            fn () => print($pdfContent),
            "sales_report_".$range.".pdf"
        );
    }

    public function redirectTo($route){
        return redirect()->route($route);
    }

    public function render()
    {
        /*
        "id" => 2
        "user_id" => 2
        "address_book_id" => 1
        "subtotal" => 1610.0
        "discount" => null
        "shippingfee" => 300.0
        "total" => 9000.0
        "status" => "ordered"
        "created_at" => "2022-10-29 20:54:05"
        "updated_at" => "2022-07-09 20:54:05"
        "transaction_id" => null
        "uuid" => "f9a2b033-e39b-4215-bfc9-c281f2436c7a"
        "shipping_type" => "express"
        */
        $orders = Order::select(DB::raw('count(*) count, sum(total) total, DATE(created_at) date, YEAR(created_at) year, MONTH(created_at) month'));
     
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
                    ->whereDate('created_at', '>=', date($this->year_from.'-'.$this->month_from.'-01').' 00:00:00')
                    ->whereDate('created_at', '<=', date($this->year_from.'-'.$this->month_from.'-31').' 23:59:59');
                }
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
                //Leave blank
            }
        if($this->group_by == 'date'){
            $orders->groupBy('date');
        }  
        else if($this->group_by == 'month_year'){
            $orders->groupBy('year', 'month');
        }
        else if($this->group_by == 'year'){
            $orders->groupBy('year');
        } 
        else {
            redirect()->route('admin.reports');
        }
           // whereDate('created_at', '=', $this->date) 
          //  ->where('status', '!=', 'cancelled') 
            //->paginate(10);
            
        $this->genOrders = $orders->get();
        $orders = $orders->get();

        //$orders = $orders->paginate(10);

        return view('livewire.admin.sales-report-group', compact('orders'))->layout('layouts.admin');
    }
}
