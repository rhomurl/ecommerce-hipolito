<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'name', 'slug', 'description', 'selling_price', 'quantity', 'image', 'category_id', 'brand_id'
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::saving(function ($model) {
            $model->slug = Str::slug($model->name);
        });
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
