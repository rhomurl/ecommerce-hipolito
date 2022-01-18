<?php

namespace App\Http\Livewire\Admin;

use LivewireUI\Modal\ModalComponent;

class SuccessModal extends ModalComponent
{
    public function mount($message)
    {
        $this->message = $message;
    }

    public function fClose()
    {
        $this->emit('updateComponent');
        $this->forceClose()->closeModal();
    }

    public function render()
    {
        return view('livewire.admin.success-modal');
    }
}
