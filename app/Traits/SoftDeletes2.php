<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait SoftDeletes2
{
    public function delete()
    {
        $this->deleted_at = now();
        $this->deleted_by = Auth::user()->id;
        $this->save();
    }
}