<?php

namespace App\Http\Livewire\Admin;

use App\Models\ProductStock;
use App\Services\ReportService;
use App\Traits\ModelComponentTrait;
use Carbon\Carbon;
use Livewire\WithPagination;
use PDF;
use DB;

use Livewire\Component;

class StockReport extends Component
{
    use ModelComponentTrait, WithPagination;

    public $selected_filter, $group_by;
    public $month_from, $month_to, $year_from, $year_to;
    public $date_from, $date_to;
    public $genOrders, $range, $data1;
    public $groupProduct = false;

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
        $range = $this->getRange();

        $data = [
            'groupProduct' => $this->groupProduct,
            'genOrders' => $this->genOrders,
            'generatedAt' => Carbon::now()->format('M d Y h:i A'),
            'range' => $range
        ];
        //$pdf = PDF::loadView('pdf.sales-report', $data);
        //return $pdf->download('sales-report_.pdf');
        //return $pdf->stream();

        $pdfContent = PDF::loadView('pdf.stock-report', $data)->output();
        return response()->streamDownload(
            fn () => print($pdfContent),
            "stock_report_".$range.".pdf"
        );
    }
    
    public function exportCsv(){
        $range = $this->getRange();

        $fileName = 'stock_report_'.$range; 

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        $genOr = $this->genOrders;

        /*if(){
            $columns = array('Product Name', 'Quantity', 'Created Date');
        } else{}*/
        $columns = array('Product Name', 'Quantity', $this->groupProduct == true ? : 'Remarks', 'Created Date');
        
        

        $callback = function() use($genOr, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($genOr as $stock) {
                $row['Product Name']  = $stock->product->name;
                $row['Quantity']    = $stock->quantity;
                $row['Created Date']  = \Carbon\Carbon::parse($stock->created_at)->format('m-d-Y');

                if($this->groupProduct == false)
                {
                    $row['Remarks']    = $stock->remarks;
                    fputcsv($file, array($row['Product Name'], $row['Quantity'], $row['Remarks'], $row['Created Date']));
                } else{
                    fputcsv($file, array($row['Product Name'], $row['Quantity'], $row['Created Date']));
                }
                
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

        if($this->selected_filter){
            $orders = resolve(ReportService::class)->get_filter($orders, $this->data1);
        }
        
        if($this->groupProduct == true){
            $this->genOrders = $orders
                ->groupBy('product_id')
                ->orderBy('created_at', 'DESC')
                ->get();
        }else{
            $this->genOrders = $orders
            ->orderBy('created_at', 'DESC')
            ->get();
        }

           
        if($this->groupProduct == true){
            $orders = $orders
                ->select("product_id", "quantity", "created_at", DB::raw("sum(quantity) as stock_total"))
                ->orderBy('created_at', 'DESC')
                ->groupBy('product_id')
                ->paginate(10);
        }else{
            $orders = $orders
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
        }

        /*$topProducts = OrderProduct::select("product_id", ,
        DB::raw("sum(quantity) as product_qty"))
                        ->groupBy('product_id')
                        ->orderBy('product_qty', 'DESC')
                        ->take(5)
                        ->get();*/
        

        return view('livewire.admin.stock-report', compact('orders'))->layout('layouts.admin');
    }
}
