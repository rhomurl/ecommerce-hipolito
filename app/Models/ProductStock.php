<?php

namespace App\Models;

use App\Traits\SearchableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    use SearchableTrait, HasFactory;

    protected $table = "product_stock";
    
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'product_id', 
        'quantity', 
        'remarks'
    ];

    public $searchable = [
        'product.name', 
        'product.quantity', 
        'quantity', 
        'remarks'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    

}
