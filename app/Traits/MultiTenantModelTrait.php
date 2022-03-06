<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Models\Role;

trait MultiTenantModelTrait
{
    public static function bootMultiTenantModelTrait()
    {
        if(!app()->runningInConsole() && auth()->check()){
            $isAdmin = auth()->user()->roles->contains(2);
            static::creating(function ($model) use ($isAdmin){

                if(!$isAdmin){
                    $model->user_id = auth()->id();
                }
            });

            if(!$isAdmin){
                static::addGlobalScope('user_id', function (Builder $builder){
                    $builder->where('user_id', auth()->id());
                });
            }
        }
    }
}