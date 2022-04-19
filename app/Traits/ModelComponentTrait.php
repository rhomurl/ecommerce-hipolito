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

    public function successToast($message){
        $this->alert('success', $message, [
            'position' => 'bottom-end',
            'timer' => '1500',
            'toast' => true,
            'timerProgressBar' => true,
        ]);
    }

    public function errorToast($message){
        $this->alert('error', $message, [
            'position' => 'bottom-end',
            'timer' => '1500',
            'toast' => true,
            'timerProgressBar' => true,
        ]);
    }

    private function resetInputFields(){
        $this->reset();
        $this->resetValidation();
    }

    public function getProductURL($url){
        $disk = \Storage::disk('gcs');
        return $disk->temporaryUrl($url, now()->addMinutes(30));
    }
}