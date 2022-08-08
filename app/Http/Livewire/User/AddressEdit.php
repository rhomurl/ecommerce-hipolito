<?php

namespace App\Http\Livewire\User;

use App\Services\ActivityLogService;
use App\Traits\ModelComponentTrait;
use App\Models\City;
use App\Models\Barangay;
use App\Models\AddressBook;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class AddressEdit extends Component
{
    use ModelComponentTrait;

    public $barangays, $barangay;
    public $cities, $city;

    public $company, $firstname, $lastname, $landmark, $street_address, $phonenumber, $postcode;
    public $error_message;

    protected $rules =  [
        'company' => 'nullable|string|max:255',
        'firstname' => 'required|alpha|max:255',
        'lastname' => 'required|alpha|max:255',
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

        $barangay_old = Barangay::find($address->barangay_id);
        $this->old = [
            [
                'entry_company' => $address->entry_company, 
                'entry_firstname' => $address->entry_firstname,
                'entry_lastname' => $address->entry_lastname,
                'entry_street_address' => $address->entry_street_address,
                'entry_landmark' => $address->entry_landmark,
                'barangay' => $barangay_old->name,
                'city' => $barangay_old->city->name,
                'entry_phonenumber' => $address->entry_phonenumber
            ]
        ];
    }

    public function storeAddress(ActivityLogService $activity)
    {
        $this->validate();
        try {
            $address_book = AddressBook::updateOrCreate(['id' => $this->address_id],
                ['entry_company' => $this->company,
                'entry_firstname' => $this->firstname,
                'entry_lastname' => $this->lastname,
                'entry_landmark' => $this->landmark,
                'entry_street_address' => $this->street_address,
                'barangay_id' => $this->barangay,
                'entry_phonenumber' => $this->phonenumber
                ]);

                
            // AFTER NG UPDATE AND DELETE
            // COMPANY
            $barangay_new = Barangay::find($this->barangay);
            
            $old = $this->old; 
            $attributes = [
                [
                    'entry_company' => $this->company,
                    'entry_firstname' => $this->firstname,
                    'entry_lastname' => $this->lastname,
                    'entry_landmark' => $this->landmark,
                    'entry_street_address' => $this->street_address,
                    'barangay' => $barangay_new->name,
                    'city' => $barangay_new->city->name,
                    'entry_phonenumber' => $this->phonenumber
                ]
            ];
            $activity->createLog($address_book, $old, $attributes, 'Updated Address');
            //
            //session()->flash('message', 'Address Edited Successfully'); 
            //sleep(5); //add message success
            
                
        } 
        catch (\Exception $exception){
            $this->error_message = "Something went wrong";
        }
        
        session()->flash('message', 'Address Edited Successfully'); 
        return redirect()->route('user.address');
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
