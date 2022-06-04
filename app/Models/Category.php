<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'categories';
    protected $fillable = ['name', 'slug', 'type', 'deleted_at' ,'deleted_by'];

    protected static function boot()
    {
        parent::boot();
        
        /*static::saving(function ($model) {
            $model->slug = Str::slug($model->name);
        });*/
    }

    public function product() {
        return $this->hasMany(Product::class);
    }
}
