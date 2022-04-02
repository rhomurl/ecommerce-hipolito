<?php

namespace App\Http\Livewire\Admin;

use Jantinnerezo\LivewireAlert\LivewireAlert;

use App\Models\User;
use App\Traits\ModelComponentTrait;

use Spatie\Permission\Models\Role;
//use Spatie\Permission\Models\Permission;

use LivewireUI\Modal\ModalComponent;

class RoleEdit extends ModalComponent
{
    use LivewireAlert;
    use ModelComponentTrait;
    
    public $role, $user_id, $role_id, $name, $role_user;

    public function mount($id)
    {
        $this->user_id = $id;
        $user = User::findOrFail($id);
        $this->name = $user->name;
        $this->role_user = $user->getRoleNames()->first();
        
    }

    public function edit(){
        $user = User::findorFail($this->user_id);
        $user->removeRole($this->role_user);
        $user->assignRole($this->role_id);
        
        //$this->emit("openModal", "admin.success-modal", ["message" => $this->banner_id ? 'Banner Updated Successfully.' : 'Banner Added Successfully']);
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
