<?php

namespace App\Services;
use App\Exceptions\AddressAttachedToOrderException;
use Illuminate\Support\Facades\Auth;
use App\Models\AddressBook;
use App\Models\User;
use App\Models\Order;

class AddressService {

    public function setUserAddressBook($id)
    {
        $user = User::find(Auth::id());
        $user->address_book_id = $id;
        $user->save();
        return $user;
    }

    public function checkAddress($id)
    {
        $count_order = Order::where('address_book_id', $id)->count();
        if($count_order) {
            throw new AddressAttachedToOrderException;
            
        }
    }
}