<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\AddressBook;
use App\Models\User;

class AddressService {

    public function setUserAddressBook($id)
    {
        $user = User::find(Auth::id());
        $user->address_book_id = $id;
        $user->save();
        return $user;
    }
}