<?php

namespace App\Http\Livewire\Admin;

use Jantinnerezo\LivewireAlert\LivewireAlert;

use Illuminate\Support\Facades\Auth;
use App\Traits\ModelComponentTrait;
use App\Models\User;

use Livewire\WithPagination;
use Livewire\Component;

class RoleManagement extends Component
{
    use LivewireAlert;
    use ModelComponentTrait;
    use WithPagination;

    public $search = "";

    public function render()
    {
        $users = User::where('name', 'like', '%'.$this->search.'%')
            ->where('id', '!=', Auth::id())
            ->orderBy('name', 'ASC')
            ->paginate(10);

       

        return view('livewire.admin.role-management', compact('users'))->layout('layouts.admin');
    }
}
