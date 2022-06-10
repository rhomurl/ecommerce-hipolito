<?php

namespace App\Http\Livewire\User;

use App\Models\City;
use App\Models\Barangay;
use App\Models\AddressBook;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddressEdit extends Component
{
    public $barangays, $barangay;
    public $cities, $city;

    public $company, $firstname, $lastname, $landmark, $street_address, $phonenumber, $postcode;
    public $error_message;

    protected $rules =  [
        'company' => 'nullable|string|max:255',
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'landmark' => 'required|string|max:255',
        'street_address' => 'required|max:255',
        'phonenumber' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
    ];

    protected $messages = [
        'phonenumber.regex' => 'Phonenumber format is invalid.',
    ];
 
    public function mount($id)
    {
        $this->address_id = $id;
        $address = AddressBook::findOrFail($this->address_id);
        $this->barangay = $address->barangay->id;
        $this->city = $address->barangay->city->id;
        $this->company = $address->entry_company;
        $this->firstname = $address->entry_firstname;
        $this->lastname = $address->entry_lastname;
        $this->landmark = $address->entry_landmark;
        $this->street_address = $address->entry_street_address;
        $this->phonenumber = $address->entry_phonenumber;
        $this->postcode = $address->entry_postcode;
        $this->cities = City::all();
        //$this->barangays = collect();
        $this->barangays = Barangay::where('city_id',  $this->city)->get();
        //$this->barangay = $this->barangays->first()->id ?? null;
    }

    public function storeAddress()
    {
        $this->validate();
        try {
            AddressBook::updateOrCreate(['id' => $this->address_id],
                ['entry_company' => $this->company,
                'entry_firstname' => $this->firstname,
                'entry_lastname' => $this->lastname,
                'entry_landmark' => $this->landmark,
                'entry_street_address' => $this->street_address,
                'barangay_id' => $this->barangay,
                'entry_phonenumber' => $this->phonenumber
                ]);
            
            //session()->flash('message', 'Address Edited Successfully'); 
            sleep(5);
            return redirect()->route('user.address');
                
        } 
        catch (\Exception $exception){
            //$this->error_message = $exception;
            $this->error_message = "Something went wrong";
        }
    }

    public function updatedCity($value)
    {
        $this->barangays = Barangay::where('city_id', $value)->get();
        $this->barangay = $this->barangays->first()->id ?? null;
    }

    public function render()
    {
        return view('livewire.user.address-edit')->extends('layouts.user-profile');
    }
}
