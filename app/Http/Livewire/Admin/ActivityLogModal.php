<?php

namespace App\Http\Livewire\Admin;

use App\Models\ActivityLog;
use LivewireUI\Modal\ModalComponent;

class ActivityLogModal extends ModalComponent
{
    public function mount(ActivityLog $activity){
        $this->activity = $activity;
    }
    public function render()
    {
        return view('livewire.admin.activity-log-modal');
    }
}
