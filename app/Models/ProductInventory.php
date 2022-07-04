<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInventory extends Model
{
    use HasFactory;
    protected $table = "product_inventory";

    protected $fillable = [
        'status', 'product_id', 'supplier', 'product_cost', 'starting_stock', 'reorder_level', 'received_at'
    ];

    protected $casts = [
        'received_at' => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
