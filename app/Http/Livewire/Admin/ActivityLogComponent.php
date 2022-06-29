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

    public function render()
    {
        $activities = ActivityLog::with('user')
            ->latest()
            ->where('description', 'LIKE','%'.$this->search.'%')
            ->where('properties', 'LIKE','%'.$this->search.'%')
            ->paginate(10);

        return view('livewire.admin.activity-log-component', compact('activities'))->layout('layouts.admin');
    }
}
