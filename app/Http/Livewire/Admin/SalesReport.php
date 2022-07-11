<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use App\Traits\ModelComponentTrait;
use Carbon\Carbon;

use App\Services\ReportService;
use PDF;

//use DB;
use Livewire\Component;
//use Session;

class SalesReport extends Component
{
    use ModelComponentTrait;

    public $selected_filter, $group_by;
    public $month_from, $month_to, $year_from, $year_to;
    public $date_from, $date_to;
    public $genOrders, $range, $data1;

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
            'genOrders' => $this->genOrders,
            'generatedAt' => Carbon::now()->format('M d Y h:i A'),
            'range' => $range
        ];
        //$pdf = PDF::loadView('pdf.sales-report', $data);
        //return $pdf->download('sales-report_.pdf');
        //return $pdf->stream();

        $pdfContent = PDF::loadView('pdf.sales-report', $data)->output();
        return response()->streamDownload(
            fn () => print($pdfContent),
            "sales_report_".$range.".pdf"
        );
    }

    public function exportCsv(){
        $range = $this->getRange();

        $fileName = 'sales_report_'.$range; 

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        $genOr = $this->genOrders;
        $columns = array('Order #', 'Payment Method', 'Status', 'Order Date', 'Total');

        $callback = function() use($genOr, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($genOr as $order) {
                $row['Order #']  = $order->id;
                $row['Payment Method']    = $order->getPaymentModeAttribute();
                $row['Status']    = $order->getOrderStatusAttribute();
                $row['Order Date']  = \Carbon\Carbon::parse($order->created_at)->format('m-d-Y');
                $row['Total']  = number_format($order->total, 2);

                fputcsv($file, array($row['Order #'], $row['Payment Method'], $row['Status'], $row['Order Date'], $row['Total']));
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
        $orders = Order::query();

        if($this->selected_filter){
            $orders = resolve(ReportService::class)->get_filter($orders, $this->data1);
        }
        

        $this->genOrders = $orders
            ->where('status', '!=', 'cancelled')
            ->orderBy('created_at', 'DESC')
            ->get();

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