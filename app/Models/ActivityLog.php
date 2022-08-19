<?php

namespace App\Models;

use App\Traits\SearchableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory, SearchableTrait;
    protected $table = "activity_log";

    protected $fillable = [
        'log_name', 
        'description', 
        'model_id', 
        'model_type', 
        'user_id', 
        'properties', 
        'role'
    ];

    public $searchable = [
        'log_name', 
        'description', 
        'user.name'
    ];
    
    protected $casts = [
        'properties' => 'array'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
