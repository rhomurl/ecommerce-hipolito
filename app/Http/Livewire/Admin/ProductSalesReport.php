<?php

namespace App\Http\Livewire\Admin;

use App\Models\OrderProduct;
use App\Traits\ModelComponentTrait;
use Carbon\Carbon;
use DB;
use Livewire\{Component, WithPagination};
use PDF;

class ProductSalesReport extends Component
{
    use WithPagination; 
    
    
    public function generatePDF(){
        $order_products = OrderProduct::join('orders', 'order_product.order_id', '=', 'orders.id')
       ->select('orders.created_at', 'orders.status', DB::raw('count(*) count, product_id, sum(quantity) total_quantity, price, (price * sum(quantity)) as total_amount'))
        ->groupBy('product_id')
        ->orderBy('total_quantity', 'DESC')
        ->where('orders.status', '!=', 'cancelled')
        ->get();

        //$range = $this->getRange();

        $data = [
            'order_products' => $order_products,
            'generatedAt' => Carbon::now()->format('M d Y h:i A'),
            //'range' => $range
        ];
        //$pdf = PDF::loadView('pdf.sales-report', $data);
        //return $pdf->download('sales-report_.pdf');
        //return $pdf->stream();

        $pdfContent = PDF::loadView('pdf.product-sales-report', $data)->setPaper('a4', 'landscape')->output();
        return response()->streamDownload(
            fn () => print($pdfContent),
            "product_sales_report.pdf"
        );
    }

    public function exportCsv(){
        $order_products = OrderProduct::join('orders', 'order_product.order_id', '=', 'orders.id')
       ->select('orders.created_at', 'orders.status', DB::raw('count(*) count, product_id, sum(quantity) total_quantity, price, (price * sum(quantity)) as total_amount'))
        ->groupBy('product_id')
        ->orderBy('total_quantity', 'DESC')
        ->where('orders.status', '!=', 'cancelled')
        ->get();
        //$range = $this->getRange();

        $fileName = 'product_sales_report';

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Product Name', 'Products Sold', 'Current Stock', 'Product Cost', 'Selling Price', 'Total', 'Profit');

        $callback = function() use($order_products, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($order_products as $order_product) {
                $row['Product Name']  = $order_product->product->name;
                $row['Products Sold'] = $order_product->total_quantity;
                $row['Current Stock'] = $order_product->product->quantity;
                $row['Product Cost'] = $order_product->product->productInventory->product_cost;
                $row['Selling Price']    = $order_product->price;
                $row['Total']  = $order_product->total_amount;
                $row['Profit']  = $order_product->total_amount - ($order_product->product->productInventory->product_cost * $order_product->total_quantity);

                fputcsv($file, array($row['Product Name'], $row['Products Sold'], $row['Current Stock'], $row['Product Cost'], $row['Selling Price'], $row['Total'], $row['Profit']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
    
    public function render()
    {
        /*
         "id" => 1
        "order_id" => 1
        "product_id" => 48
        "user_id" => 5
        "price" => 276.0
        "quantity" => 1
        "received_at" => "0000-00-00 00:00:00"
        "address_book_id" => 1
        "subtotal" => 1225.0
        "discount" => null
        "shippingfee" => 500.0
        "total" => 1725.0
        "status" => "ordered"
        "created_at" => "2022-07-12 19:24:12"
        "updated_at" => "2022-07-12 19:24:12"
        "transaction_id" => null
        "uuid" => "9e1157f9-f381-4d70-9f3e-5a0b7041c26a"
        "shipping_type" => "express"
      ]
      */
        $order_products = OrderProduct::join('orders', 'order_product.order_id', '=', 'orders.id')
        //->join('product_inventory', 'order_product.product_id', '=', 'product_inventory.product_id')
       ->select('orders.created_at', 'orders.status', DB::raw('count(*) count, product_id, sum(quantity) total_quantity, price, (price * sum(quantity)) as total_amount'))
        ->groupBy('product_id')
        ->orderBy('total_quantity', 'DESC')
        ->where('orders.status', '!=', 'cancelled')
        ->paginate(10);
        //dd($order_products);
        //$order_product->price * $order_product->total_quantity) - ($order_product->product_cost * $order_product->total_quantity
      /*  "status" => "ordered"
        "count" => 2
        "product_id" => 5
        "total_quantity" => "2"
        "price" => 250.0

*/
            //dd($productxx->product->name);
        
       
        return view('livewire.admin.product-sales-report', compact('order_products'))->layout('layouts.admin');
    }

    public function redirectTo($route){
        return redirect()->route($route);
    }
}
