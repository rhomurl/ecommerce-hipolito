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
