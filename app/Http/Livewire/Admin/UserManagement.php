<?php

namespace App\Http\Livewire\Admin;

use App\Services\ActivityLogService;
use App\Traits\ModelComponentTrait;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;

use Livewire\Component;

class UserManagement extends Component
{
    use LivewireAlert, ModelComponentTrait, WithPagination;

    public $search = "";
    public $sortColumn = 'name';
    public $sortDirection = 'asc';

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
        $users = User::role('customer')
            ->where('name', 'like', '%'.$this->search.'%')
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate(10);

        return view('livewire.admin.user-management',  compact('users'))->layout('layouts.admin');
    }

    public function view($id)
    {
        $this->emit("openModal", "admin.view-user-info", ["id" => $id]);
    }

    public function changeUserStatus(User $user, $status, ActivityLogService $activity){
        if($user){
            $user->status = $status;
            $user->save();

            $attributes = [
                ['id' => $user->id, 'status' => $status]
            ];

            if($status == 0){
                $activity->createLog($user, "", $attributes, 'Disabled user');
            }
            else if($status == 1){
                $activity->createLog($user, "", $attributes, 'Enabled user');
            } 

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
