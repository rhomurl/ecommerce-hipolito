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
            $isCustomer = auth()->user()->roles->contains(1);
            //$isAdmin = auth()->user()->roles->contains(2);
            //$isSuperAdmin = auth()->user()->roles->contains(3);

            static::creating(function ($model) use ($isCustomer){
                if($isCustomer){
                    $model->user_id = auth()->id();
                }
            });

            if($isCustomer){
                static::addGlobalScope('user_id', function (Builder $builder){
                    $builder->where('user_id', auth()->id());
                });
            }
        }
    }
}