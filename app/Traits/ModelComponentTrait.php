<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Models\Role;

trait ModelComponentTrait
{
    public function getData($model)
    {
        return $model::where('name', 'like', '%'.$this->search.'%')
        ->orderBy('name', 'ASC')
        ->paginate(10);
    }
    
    public function errorAlert($message){
        $this->alert('error', $message, [
            'position' => 'center',
            'timer' => '1500',
            'toast' => false,
            'timerProgressBar' => true,
            'width' => '600',
           ]);
        $this->emit('updateComponent');
    }

    public function successAlert($message){
        $this->alert('success', $message, [
            'position' => 'center',
            'timer' => '1500',
            'toast' => false,
            'timerProgressBar' => true,
            'width' => '600',
           ]);
        $this->emit('updateComponent');
    }

    private function resetInputFields(){
        $this->reset();
        $this->resetValidation();
    }
}