<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = ['name', 'slug', 'type'];

    protected static function boot()
    {
        parent::boot();
        
        static::saving(function ($model) {
            $model->slug = Str::slug($model->name);
        });
    }

    public function product() {
        return $this->hasMany(Product::class);
    }
}
