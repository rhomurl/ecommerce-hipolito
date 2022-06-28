<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;
    protected $table = "activity_log";
    protected $fillable = ['log_name', 'description', 'model_id', 'model_type', 'user_id', 'properties' ];
    protected $casts = [
        'properties' => 'array'
    ];
}
