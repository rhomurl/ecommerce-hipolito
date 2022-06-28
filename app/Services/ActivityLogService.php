<?php

namespace App\Services;

use App\Models\ActivityLog;
//, Banner, Brand, Category, Order, Product, ProductInventory, Transaction, User
use Illuminate\Support\Facades\Auth;


class ActivityLogService {
    public $test = "";
    public function createLog($model, $description){
        
        $attributes = get_class($model)::where('id', $model->id)->select('name','slug')->get();
        $properties['old'] = '';
        $properties['attributes'] = $attributes;

        ActivityLog::create([
            'log_name' => class_basename($model),
            'description' => $description,
            'model_id' => $model->id,
            'model_type' => get_class($model),
            'user_id' => Auth::id(),
            'properties' => $properties
        ]);
    }

}

