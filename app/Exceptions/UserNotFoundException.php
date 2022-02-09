<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class UserNotFoundException extends Exception
{
    public function report(){
        Log::debug('User not found in db');
    }
}
