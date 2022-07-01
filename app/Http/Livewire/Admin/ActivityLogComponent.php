<?php

namespace App\Http\Livewire\Admin;

use App\Models\ActivityLog;
use App\Traits\ModelComponentTrait;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;

use Livewire\Component;

class ActivityLogComponent extends Component
{
    use LivewireAlert, ModelComponentTrait, WithPagination;

    public $search = "";
    public $sortColumn = 'created_at';
    public $sortDirection = 'desc';

    public function sortByColumn($column)
    {
        if ($this->sortColumn == $column) {
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        } else {
            $this->reset('sortDirection');
            $this->sortColumn = $column;
        }
    }
    
    public function render()
    {
        $activities = ActivityLog::with('user')
            ->where('description', 'LIKE','%'.$this->search.'%')
            ->where('properties', 'LIKE','%'.$this->search.'%')
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate(10);

        return view('livewire.admin.activity-log-component', compact('activities'))->layout('layouts.admin');
    }
}
