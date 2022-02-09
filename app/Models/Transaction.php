<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = "transactions";

    protected $fillable = [
        'user_id',
        'order_id',
        'mode',
        'status'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}