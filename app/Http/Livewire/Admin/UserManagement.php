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
    public $emails;

    public function render()
    {
        $users = User::role('customer')
            ->where('name', 'like', '%'.$this->search.'%')
            ->orderBy('name', 'ASC')
            ->paginate(10);
        return view('livewire.admin.user-management',  compact('users'))->layout('layouts.admin');
    }

    public function view($id)
    {
        $this->emit("openModal", "admin.view-user-info", ["id" => $id]);
    }

    public function changeUserStatus($id, $status){
        $user = User::find($id);

        if($user){
            $user->status = $status;
            $user->save();
            $this->successAlert('User Status Updated Successfully!');
        }

    }

    /*
    public function extractEmail(){
        $users = User::role('customer')->select('email')->get();

        foreach($users as $user){
            $emails[] = $user->email;
        }

    }
    */
}
