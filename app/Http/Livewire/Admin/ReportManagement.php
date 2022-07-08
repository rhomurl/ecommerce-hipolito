<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Carbon\Carbon;

class ReportManagement extends Component
{
    public $selected_filter, $group_by;
    public $month_from, $month_to, $year_from, $year_to;
    public $date_from, $date_to;
    public $data = [];
    
    protected $rules = [
        'selected_filter' => 'required',
        'date_from' => '',
    ];

    public function render()
    {
        return view('livewire.admin.report-management')->layout('layouts.admin');
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

    public function updatedSelectedFilter($value){
        
    }

    public function updatedDate(){

    }
}
