<?php

namespace App\Http\Livewire\Admin;

use LivewireUI\Modal\ModalComponent;

class FailedModal extends ModalComponent
{
    public function mount($message)
    {
        $this->message = $message;
    }

    public function fClose()
    {
        $this->forceClose()->closeModal();
    }

    public function render()
    {
        return view('livewire.admin.failed-modal');
    }
}
