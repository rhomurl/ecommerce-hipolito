<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;
use Carbon\Carbon;

class ReportManagement extends Component
{
    public $selected_filter, $group_by;
    public $month_from, $month_to, $year_from, $year_to;
    public $date_from, $date_to, $min_year, $max_year, $order_date_latest;
    public $data = [];
    public $min_date = [];
    public $max_date = [];
    
    protected $rules = [
        'selected_filter' => 'required',
        'date_from' => '',
    ];

    public function render()
    {
        $order_latest = Order::select('created_at')
            ->orderBy('created_at', 'DESC')
            ->first();
        
        $order_first = Order::select('created_at')
            ->orderBy('created_at', 'ASC')
            ->first();

        $ordertime = Carbon::parse($order_first->created_at);
        $ordertime_latest = Carbon::parse($order_latest->created_at);

        $this->year_gap = $ordertime_latest->year - $ordertime->year;
        $this->min_year = $ordertime->year;
        $this->max_year = $ordertime_latest->year;

        if($ordertime->month < 10){
            $min_date['month'] = '0' . $ordertime->month;
        }
        else{
            $min_date['month'] = $ordertime->month;
        }

        if($ordertime->day < 10){
            $min_date['day'] = '0' . $ordertime->day;
        }else{
            
            $min_date['day'] = $ordertime->day;
        }
        ////////////////////////////////////
        if($ordertime_latest->month < 10){
            $max_date['month'] = '0' . $ordertime_latest->month;
        }
        else{
            $max_date['month'] = $ordertime_latest->month;
        }
        
        if($ordertime_latest->day < 10){
            $max_date['day'] = '0' . $ordertime_latest->day;
        }else{
            
            $max_date['day'] = $ordertime_latest->day;
        }

        $min_date['year'] = $ordertime->year;

        $ordertime = $ordertime->year . '-' . $min_date['month'] . '-' . $min_date['day'];
        $this->order_date_latest = $ordertime_latest->year . '-' . $max_date['month'] . '-' . $max_date['day'];
     
        return view('livewire.admin.report-management', compact('ordertime', 'min_date'))->layout('layouts.admin');
    }

    public function submit()
    {
        $this->validate();

        $data = [
            'selected_filter' => $this->selected_filter,
            'group_by' => $this->group_by,
            'month_from' => $this->month_from,
            'month_to' => $this->month_to,
            'year_from' => $this->year_from,
            'year_to' => $this->year_to,
            'date_from' => $this->date_from,
            'date_to' => $this->date_to
        ];

        if($this->group_by)
        {
            return redirect()->route('admin.sales-report-group')
                ->with('data', $data);
        }
        else 
        {
            return redirect()->route('admin.sales-report')
            ->with('data', $data);
        }
    }
}
