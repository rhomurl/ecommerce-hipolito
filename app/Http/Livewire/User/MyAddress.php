<?php

namespace App\Http\Livewire\User;

use App\Models\AddressBook;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyAddress extends Component
{
    public function render()
    {
        $addresses = AddressBook::with('barangay.city')
        ->where('user_id', Auth::id())
        ->latest()
        ->take(5)
        ->get();

        return view('livewire.user.my-address', compact('addresses'))->extends('layouts.user-profile');;
    }

    public function delete($id)
    {
        try{
            AddressBook::findOrFail($id)->delete();
        } catch(\Exception $e){
            session()->flash('error_msg', 'This Address Cannot Be Deleted');
            return redirect(route('user.address'));
        }
    }
    public function edit($id){
        return redirect()->route('user.address.edit', ['id' => $id]);
    }   
}
