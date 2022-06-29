<?php

namespace App\Services;

use App\Models\ActivityLog;
//, Banner, Brand, Category, Order, Product, ProductInventory, Transaction, User
use Illuminate\Support\Facades\Auth;


class ActivityLogService {
    public function createLog($model, $old, $attributes, $description)
    {
        $properties['old'] = $old;
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

