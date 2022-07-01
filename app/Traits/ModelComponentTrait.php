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

    public function getData2($model)
    {
        $m = $model::query();
        $m->where('name', 'like', '%'.$this->search.'%')
            ->orderBy($this->sortColumn, $this->sortDirection);
        $m = $m->paginate(10);
        return $m;
    }



    public function getAttribute1($model){
        return $model::where('id', $model->id)
            ->select('name','slug')
            ->get();
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
            'position' => 'top-end',
            'timer' => '750',
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
        $domain = 'https://files.hipolito-hardware.xyz/';
        return $domain . $url;
        //$disk = \Storage::disk('gcs');
        //return $disk->temporaryUrl($url, now()->addMinutes(30));
        //return $disk->url($url);
    }

    public function getProductURL_maxtime($url){
        $disk = \Storage::disk('gcs');
        return $disk->temporaryUrl($url, now()->addDay(7));
    }
}