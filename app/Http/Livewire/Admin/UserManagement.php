<?php

namespace App\Http\Livewire\Admin;

use Jantinnerezo\LivewireAlert\LivewireAlert;

use App\Traits\ModelComponentTrait;
use App\Models\User;

use Livewire\WithPagination;
use Livewire\Component;

class UserManagement extends Component
{

    use LivewireAlert;
    use ModelComponentTrait;
    use WithPagination;

    public $search = "";

    public function render()
    {
        $users = $this->getData(new User());
        return view('livewire.admin.user-management',  compact('users'))->layout('layouts.admin');
    }



}
