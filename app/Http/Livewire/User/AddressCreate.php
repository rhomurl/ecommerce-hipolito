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
    public $barangays, $barangay;
    public $cities, $city;

    public $company, $firstname, $lastname, $landmark, $street_address, $phonenumber, $postcode;
    public $error_message;

    protected $rules =  [
        'company' => 'nullable|regex:/^[0-9a-zA-ZÑñ.\s]+$/|min:2|max:255',
        'firstname' => 'required|regex:/^[a-zA-ZÑñ.\s]+$/|min:3|max:50',
        'lastname' => 'required|regex:/^[a-zA-ZÑñ.\s]+$/|min:2|max:50',
        'landmark' => 'required|regex:/^[0-9a-zA-ZÑñ.\s]+$/|min:5|max:100',
        'street_address' => 'required|regex:/^[[0-9a-zA-ZÑñ.\s]+$/|min:3|max:100',
        'phonenumber' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:20'
    ];

    protected $messages = [
        'firstname.regex' => 'First name cannot contain special characters',
        'lastname.regex' => 'Last name cannot contain special characters',
        'company.regex' => 'Company cannot contain special characters',
        'landmark.regex' => 'Landmark cannot contain special characters',
        'street_address.regex' => 'Street address cannot contain special characters',
        'phonenumber.regex' => 'Phonenumber format is invalid.',
    ];

    public function mount()
    {
        $this->cities = City::all();
        $this->barangays = collect();
        $this->addressCount = AddressBook::where('user_id', Auth::user()->id)->count();
        
    }

    public function updatedCity($value)
    {
        $this->barangays = Barangay::where('city_id', $value)->get();
        $this->barangay = $this->barangays->first()->id ?? null;
    }

    public function storeAddress()
    {
        
        $this->validate();

        try {
            $address = AddressBook::create([
                //'user_id' => Auth::user()->id,
                'entry_company' => $this->company,
                'entry_firstname' => $this->firstname,
                'entry_lastname' => $this->lastname,
                'entry_landmark' => $this->landmark,
                'entry_street_address' => $this->street_address,
                'barangay_id' => $this->barangay,
                'entry_phonenumber' => $this->phonenumber,
            ]);

            if($this->addressCount == 0){
                $user = User::find(Auth::user()->id);
                $user->address_book_id = $address->id;
                $user->save();
            }

            $this->cities = collect();

            session()->flash('message', 'Address Created Successfully');
            return redirect()->route('user.address');
        }  catch (\Exception $exception){
            $this->error_message = "Something went wrong";
        }
    }

    public function render()
    {
        return view('livewire.user.address-create')->extends('layouts.user-profile');
    }
}
