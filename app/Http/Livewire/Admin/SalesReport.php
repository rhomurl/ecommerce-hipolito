<?php

namespace App\Http\Livewire\Admin;

use App\Models\{Order, User, Product};
use Livewire\Component;
use Carbon\Carbon;

class SalesReport extends Component
{
    public $salesreport = [];

    public function render()
    {
        $order = Order::query();

        $product = Order::query()->with('orderProduct');

        $product_today = $product
            ->where('status','ordered')
            ->where('created_at', '>=', now()->subDays(7))
            ->get();
            
            $this->totalc = $product_today->count();
            $this->sumc = $product_today->sum('total');

        $product_today = $product_today->groupBy(function($item) {
            return $item->created_at->format('d');
       });

        //dd($product_today);

        //$this->week = $order->where('status','ordered')->where('created_at', '>=', Carbon::now()->subDays(7))->sum('total');

        //$this->month = $order->where('status','ordered')->whereMonth('created_at', '=', date('m'))->sum('total');

        //$this->total = $order->where('status','ordered')->sum('total');

        return view('livewire.admin.sales-report', compact('product_today'))->layout('layouts.admin');
    }


    public function updatedDuratiom($value){

    }
}
