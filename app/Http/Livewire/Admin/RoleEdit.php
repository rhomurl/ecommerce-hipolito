<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use App\Services\ActivityLogService;
use App\Traits\ModelComponentTrait;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Spatie\Permission\Models\Role;
//use Spatie\Permission\Models\Permission;

use LivewireUI\Modal\ModalComponent;

class RoleEdit extends ModalComponent
{
    use LivewireAlert, ModelComponentTrait;
    
    public $role, $user_id, $role_id, $name, $role_user;

    public function mount($id)
    {
        $this->user_id = $id;
        $user = User::findOrFail($id);
        $this->name = $user->name;
        $this->role_user = $user->getRoleNames()->first();
    }

    public function edit(ActivityLogService $activity){
        $user = User::findorFail($this->user_id);
        $user->removeRole($this->role_user);
        $user->assignRole($this->role_id);

        $old = [
            ['role' => $this->role_user, 'id' => $user->id]
        ];
        $attributes = [
            ['role' => $this->role_id, 'id' => $user->id]
        ];

        $activity->createLog($user, $old, $attributes, 'Updated role');
        
        $this->resetInputFields();
        $this->closeModal();
        $this->successAlert('Role Updated Successfully!'); 
    }

    public function render()
    {
        $roles = Role::orderBy('id','ASC')->paginate(5);
        return view('livewire.admin.role-edit', compact('roles'));
    }
}
