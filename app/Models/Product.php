<?php

namespace App\Models;

use Google\Cloud\Storage\StorageClient;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\SearchableTrait;

class Product extends Model
{
    use HasFactory, SearchableTrait;

    protected $table = 'products';
    
    protected $fillable = [
        'name', 'slug', 'description', 'selling_price', 'quantity', 'image', 'category_id', 'brand_id'
    ];

    public $searchable = ['name', 'slug', 'description', 'selling_price', 'quantity', 'category.name', 'brand.name'];

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

    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
