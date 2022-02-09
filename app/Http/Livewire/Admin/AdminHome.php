<?php

namespace App\Http\Livewire\Admin;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class AdminHome extends Component
{
    use LivewireAlert;

    public function render()
    {
        return view('livewire.admin.admin-home')->layout('layouts.admin');
    }
}
