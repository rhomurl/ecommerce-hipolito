<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthRedirect extends Controller
{
    public function index(){
        if ( auth()->user()->hasAnyRole(['super-admin', 'admin']) ) {
            return redirect('/admin');
        }
        return redirect('/');
    }
}
