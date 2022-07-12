<?php

namespace App\Http\Livewire\Admin;

use App\Models\{Order, OrderProduct};
use App\Services\ReportService;
use App\Traits\ModelComponentTrait;
use Carbon\Carbon;
use DB;
use Livewire\{Component, WithPagination};
use PDF;
//use Session;

class SalesReportGroup extends Component
{
    use ModelComponentTrait;
    use WithPagination;

    public $selected_filter, $group_by;
    public $month_from, $month_to, $year_from, $year_to;
    public $date_from, $date_to, $genOrders, $range, $data1;

    public function mount(){
        if(session()->has('data')){    
            $data = session()->get('data');
            $this->data1 = $data;
            $this->selected_filter = $data['selected_filter'];
            $this->group_by = $data['group_by'];

            $this->month_from = $data['month_from'];
            $this->month_to = $data['month_to'];
            $this->year_from = $data['year_from'];
            $this->year_to = $data['year_to'];

            $this->date_from = $data['date_from'];
            $this->date_to = $data['date_to'];
        
        }
    }

    public function generatePDF(){
        $ordr = Order::select(DB::raw('count(*) count, sum(total) total, DATE(created_at) date, YEAR(created_at) year, MONTH(created_at) month'));
        
        if($this->selected_filter){
            $ordr = resolve(ReportService::class)->get_filter($ordr, $this->data1);
        }
        
        if($this->group_by == 'date'){
            $ordr->groupBy('date');
        }  
        else if($this->group_by == 'month_year'){
            $ordr->groupBy('year', 'month');
        }
        else if($this->group_by == 'year'){
            $ordr->groupBy('year');
        } 
        else {
            redirect()->route('admin.reports');
        }

        $ordr = $ordr->where('status', '!=', 'cancelled')->get();
        $range = $this->getRange();
        
        $data = [
            'genOrders' => $ordr,
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
            "sales_report_group_".$range.".pdf"
        );
    }

    public function exportCsv(){
        $ordr = Order::select(DB::raw('count(*) count, sum(total) total, DATE(created_at) date, YEAR(created_at) year, MONTH(created_at) month'));
        
        if($this->selected_filter){
            $ordr = resolve(ReportService::class)->get_filter($ordr, $this->data1);
        }
        
        if($this->group_by == 'date'){
            $ordr->groupBy('date');
        }  
        else if($this->group_by == 'month_year'){
            $ordr->groupBy('year', 'month');
        }
        else if($this->group_by == 'year'){
            $ordr->groupBy('year');
        } 
        else {
            redirect()->route('admin.reports');
        }
        

        $ordr = $ordr->where('status', '!=', 'cancelled')->get();
        $range = $this->getRange();

        $fileName = 'sales_report_group_'.$range; 

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Order Count', 'Order Date/Year', 'Total');

        $callback = function() use($ordr, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($ordr as $order) {
                
                if($this->group_by == 'date'){
                    $order_d_y = $order->date;
                }
                elseif($this->group_by == 'month_year'){
                    $order_d_y = date('M Y', strtotime($order->date));
                }
                elseif($this->group_by == 'year'){
                    $order_d_y = $order->year;
                }
                else{
                    $order_d_y = $order->date;
                }

                $row['Order Count']  = $order->count . ' order(s)';
                $row['Order Date/Year'] = $order_d_y;
                $row['Total']  = number_format($order->total, 2);

                fputcsv($file, array($row['Order Count'], $row['Order Date/Year'], $row['Total']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
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
        $orders = Order::query();
        $orders = $orders->select(DB::raw('count(*) count, sum(total) total, DATE(created_at) date, YEAR(created_at) year, MONTH(created_at) month'));
     
        if($this->selected_filter){
            $orders = resolve(ReportService::class)->get_filter($orders, $this->data1);
        }
        
        if($this->group_by == 'date'){
            $orders = $orders->groupBy('date');
        }  
        else if($this->group_by == 'month_year'){
            $orders = $orders->groupBy('year', 'month');
        }
        else if($this->group_by == 'year'){
            $orders = $orders->groupBy('year');
        } 
        else {
            redirect()->route('admin.reports');
        }

        $orders = $orders->where('status', '!=', 'cancelled')
            ->paginate(10);

        return view('livewire.admin.sales-report-group', compact('orders'))->layout('layouts.admin');
    }
}
