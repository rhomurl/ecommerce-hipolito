<?php

namespace App\Http\Livewire\Admin;

use App\Models\ProductStock;
use App\Services\ReportService;
use App\Traits\ModelComponentTrait;
use Carbon\Carbon;
use DB;
use Livewire\{Component, WithPagination};
use PDF;

class StockReportGroup extends Component
{
    use ModelComponentTrait;
    use WithPagination;

    public $selected_filter, $group_by;
    public $month_from, $month_to, $year_from, $year_to;
    public $date_from, $date_to;
    public $genOrders, $range, $data1;

    use ModelComponentTrait, WithPagination;


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
        $stock = ProductStock::select(DB::raw('product_id, count(*) count,  sum(quantity) as stock_total, DATE(created_at) date, YEAR(created_at) year, MONTH(created_at) month'));

        if($this->selected_filter){
            $stock = resolve(ReportService::class)->get_filter($stock, $this->data1);
        }
        
        if($this->group_by == 'date'){ 
            $stock->groupBy('date');
        } else if($this->group_by == 'month_year'){
            $stock->groupBy('year', 'month');
        } else if($this->group_by == 'year'){
            $stock->groupBy('year');
        } else {
            redirect()->route('admin.reports');
        }

        $stock = $stock->groupBy('product_id')->get();
        $range = $this->getRange();
        
        $data = [
            'genStocks' => $stock,
            'generatedAt' => Carbon::now()->format('M d Y h:i A'),
            'range' => $range,
            'group_by' => $this->group_by
        ];

        $pdfContent = PDF::loadView('pdf.stock-report-group', $data)->output();
        return response()->streamDownload(
            fn () => print($pdfContent),
            "stock_report_group_".$range.".pdf"
        );
    }
    
    public function exportCsv(){

        $genOr = ProductStock::select(DB::raw('product_id, count(*) count,  sum(quantity) as stock_total, DATE(created_at) date, YEAR(created_at) year, MONTH(created_at) month'));


        if($this->selected_filter){
            $genOr = resolve(ReportService::class)->get_filter($genOr, $this->data1);
        }

        if($this->group_by == 'date'){
            $genOr->groupBy('date');
        }  
        else if($this->group_by == 'month_year'){
            $genOr->groupBy('year', 'month');
        }
        else if($this->group_by == 'year'){
            $genOr->groupBy('year');
        } 
        else {
            redirect()->route('admin.reports');
        }

        $genOr = $genOr->groupBy('product_id')->get();
        $range = $this->getRange();

        $fileName = 'stock_report_group_'.$range; 

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Product Name', 'Quantity', 'Created Date/Year');
        
        

        $callback = function() use($genOr, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($genOr as $stock) {

                if($this->group_by == 'date'){
                    $order_d_y = $stock->date;
                }
                elseif($this->group_by == 'month_year'){
                    $order_d_y = date('M Y', strtotime($stock->date));
                }
                elseif($this->group_by == 'year'){
                    $order_d_y = $stock->year;
                }
                else{
                    $order_d_y = $stock->date;
                }

                $row['Product Name']  = $stock->product->name;
                $row['Quantity']    = $stock->stock_total;
                $row['Created Date/Year']  = $order_d_y;

                
                fputcsv($file, array($row['Product Name'], $row['Quantity'], $row['Created Date/Year']));
                
                
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
        $orders = ProductStock::query();
        //sum(total) total,
        $orders = $orders->select(DB::raw('product_id, count(*) count,  sum(quantity) as stock_total, DATE(created_at) date, YEAR(created_at) year, MONTH(created_at) month'));
     

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

        $orders = $orders
        ->orderBy('created_at', 'DESC')
        ->groupBy('product_id')
        ->paginate(10);
       
       
        return view('livewire.admin.stock-report-group', compact('orders'))->layout('layouts.admin');
    }
}
