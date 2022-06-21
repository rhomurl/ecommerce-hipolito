<?php

namespace App\Http\Livewire\Admin;

use App\Models\{Order, User};
use Livewire\Component;
use Carbon\Carbon;

class SalesReport extends Component
{
    public $salesreport = [];

    public function render()
    {
        $order = Order::query();

        $this->week = $order->where('status','ordered')
        ->where('created_at', '>=', Carbon::now()->subDays(7))
        ->sum('total');

        $this->month = $order->where('status','ordered')
        ->whereMonth('created_at', '=', date('m'))
        ->sum('total');

        $this->total = $order->where('status','ordered')
        ->sum('total');

        return view('livewire.admin.sales-report')->layout('layouts.admin');
    }
}
