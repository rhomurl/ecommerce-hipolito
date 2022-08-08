<?php

namespace App\Services;

use App\Models\{ActivityLog, User};
//, Banner, Brand, Category, Order, Product, ProductInventory, Transaction, User

class ActivityLogService {
    public function createLog($model, $old, $attributes, $description)
    {
        $properties['old'] = $old;
        $properties['attributes'] = $attributes;

        $user = User::findorFail(auth()->user()->id);
        
        $activity = ActivityLog::create([
            'log_name' => class_basename($model),
            'description' => $description,
            'model_id' => $model->id,
            'model_type' => get_class($model),
            'user_id' => auth()->user()->id,
            'properties' => $properties,
            'role' => $user->getRoleNames()->first()
        ]);

        return $activity;
    }

}

