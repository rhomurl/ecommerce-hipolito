<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brands';
    protected $fillable = ['name', 'slug'];

    protected static function boot()
    {
        parent::boot();
        
        static::saving(function ($model) {
            $model->slug = Str::slug($model->name);
        });
    }

    public function brand() {
        $this->belongsToMany(Brand::class, 'product');
    }

    public function product() {
        return $this->hasMany(Product::class);
    }
}
