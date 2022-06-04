<?php

namespace App\Service;

use App\Models\Order;

class CheckoutService{

    public function __construct( $user, $transactionID )
    {
        $this->user = $user;
        $this->transactionID = $transactionID;
    }

}