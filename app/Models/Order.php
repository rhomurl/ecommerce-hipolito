<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Traits\MultiTenantModelTrait;
use App\Traits\SearchableTrait;

class Order extends Model
{
    use HasFactory, MultiTenantModelTrait, Notifiable, SearchableTrait;

    protected $dates = [
        'created_at',
        'updated_at',
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
        'transaction_id',
        'uuid',
        'shipping_type',
        'admin_id',
    ];

    public $searchable = ['id', 'user.name', 'subtotal', 'total', 'shipping_type', 'admin_id'];


    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }

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

    public function getPaymentModeAttribute()
    {
        switch ($this->transaction->mode){
            case 'paypal': return 'PayPal'; break;
            case 'creditcard': return 'Credit Card'; break;
            case 'grab_pay': return 'Grab Pay'; break;
            case 'gcash': return 'GCash'; break;
            case 'cod': return 'Cash on Delivery'; break;
            default: return ''; break;
        }
    }

    public function getOrderStatusAttribute(){
        switch ($this->status){
            case 'ordered': return 'Ordered'; break;
            case 'delivered': return 'Delivered'; break;
            case 'otw': return 'On The Way'; break;
            case 'processing': return 'Processing'; break;
            case 'cancelled': return 'Cancelled'; break;
            case 'pending': return 'Pending'; break;
            default: return $this->status; break;
        }
    }
}
