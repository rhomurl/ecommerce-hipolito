<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory, MultiTenantModelTrait;
    
    protected $fillable = [
        'user_id', 
        'product_id', 
        'qty'
    ];

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    
}
