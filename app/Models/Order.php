<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Traits\MultiTenantModelTrait;

class Order extends Model
{
    use HasFactory, MultiTenantModelTrait, Notifiable;

    protected $dates = [
        'created_at',
        'updated_at',
        //'deleted_at'
    ];
    
    protected $fillable = [
        'id',
        'user_id',
        'address_book_id', 
        'subtotal',
        'shippingfee',
        'discount',
        'total',
        'status',
    ];

    public function products(){
        return $this->belongsToMany(Product::class)
            ->withPivot(['quantity', 'price']);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function address()
    {
        return $this->hasOne(AddressBook::class, 'address_book_id');
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
}
