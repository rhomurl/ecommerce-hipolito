<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressBook extends Model
{
    protected $table = 'address_book';
    protected $fillable = ['user_id', 'entry_company', 'entry_firstname', 'entry_lastname', 'entry_landmark', 'entry_street_address', 'barangay_id', 'entry_phonenumber', 'entry_postcode'];
    
    use HasFactory;

    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }
}

