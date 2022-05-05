<?php

namespace App\Http\Livewire\User;

use App\Models\AddressBook;
use App\Models\Barangay;
use App\Models\City;
use App\Models\User;
use Illuminate\Support\Facades\Auth;    
use Livewire\Component;

class AddressCreate extends Component
{
    public $barangays;
    public $cities;

    public $error_message, 
    $entry_company, 
    $entry_landmark, 
    $entry_firstname, 
    $entry_lastname, 
    $entry_street_address, 
    $entry_phonenumber, 
    $entry_postcode;

    public $barangay;
    public $city;

    public function mount()
    {
        $this->cities = City::all();
        $this->barangays = collect();
        
    }

    public function render()
    {
        /*$addresses = AddressBook::with('barangay.city')
            ->where('user_id', Auth::id())
            ->latest()
            ->take(5)
            ->get();*/

            
        return view('livewire.user.address-create')->extends('layouts.user-profile');
    }

    public function updatedCity($value)
    {
        $this->barangays = Barangay::where('city_id', $value)->get();
        $this->barangay = $this->barangays->first()->id ?? null;
    }


    public function storeAddress()
    {
        $addrcount = AddressBook::where('user_id', Auth::user()->id)->count();

        $this->validate([
            'entry_company' => 'max:255',
            'entry_firstname' => 'required|string|max:255',
            'entry_lastname' => 'required|string|max:255',
            'entry_landmark' => 'required|string|max:255',
            'entry_street_address' => 'required|max:255',
            'entry_phonenumber' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ]);

        try{
            
            $c_address = AddressBook::create([
                'user_id' => Auth::user()->id,
                'entry_company' => $this->entry_company,
                'entry_firstname' => $this->entry_firstname,
                'entry_lastname' => $this->entry_lastname,
                'entry_landmark' => $this->entry_landmark,
                'entry_street_address' => $this->entry_street_address,
                'barangay_id' => $this->barangay,
                'entry_phonenumber' => $this->entry_phonenumber,
            ]);

            if($addrcount == 0){
                $user = User::find(Auth::user()->id);
                $user->address_book_id = $c_address->id;
                $user->save();

            }
            //$transaction = Transaction::where('order_id', '=', $user_orderid)
            //$cart->update(['qty' => $cart->qty + $qty]);
            //->update(array('status' => 'cancelled'));

            $this->entry_company = '';
            $this->entry_firstname = '';
            $this->entry_lastname = '';
            $this->entry_landmark = '';
            $this->entry_street_address = '';
            $this->entry_phonenumber = '';

            $this->cities = collect();

            session()->flash('message', 'Address Created Successfully');
            return redirect(route('user.address'));
        }  catch (\Exception $exception){
            $this->error_message = "Something went wrong";
        }
    }
}
