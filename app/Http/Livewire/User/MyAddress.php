<?php

namespace App\Http\Livewire\User;

use App\Models\{AddressBook, User, Barangay};
use App\Services\ActivityLogService;
use App\Services\AddressService;
use App\Traits\ModelComponentTrait;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\AddressAttachedToOrderException;
use Livewire\Component;

class MyAddress extends Component
{
    use ModelComponentTrait;

    protected $listeners = ['updateComponent' => 'render'];

    public function render()
    {
        
        $addresses = AddressBook::with('barangay.city')
        ->where('user_id', Auth::id())
        ->orderBy('created_at', 'ASC')
        ->take(5)
        ->get();

        return view('livewire.user.my-address', compact('addresses'))->extends('layouts.user-profile');;
    }

    public function delete($id, ActivityLogService $activity)
    {
        try{
            resolve(AddressService::class)->checkAddress($id);
            if(auth()->user()->address_book_id == $id){
                $user = User::find(auth()->user()->id);
                $user->address_book_id = 0;
                $user->save();
            }
            
            $address_book = AddressBook::findOrFail($id);
            
            $barangay_old = Barangay::find($address_book->barangay_id);

            $attributes = [
                [
                    'entry_company' => $address_book->entry_company,
                    'entry_firstname' => $address_book->entry_firstname,
                    'entry_lastname' => $address_book->entry_lastname,
                    'entry_landmark' => $address_book->entry_landmark,
                    'entry_street_address' => $address_book->entry_street_address,
                    'barangay' => $barangay_old->name,
                    'city' => $barangay_old->city->name,
                    'entry_phonenumber' => $address_book->entry_phonenumber
                ]
            ];
            $activity->createLog($address_book, '', $attributes, 'Deleted Address');
            $address_book->delete();

            
            $this->successToast('Address Deleted Successfully!');
            
        } catch(AddressAttachedToOrderException $exception){
            $this->errorAlert('Address Cannot Be Deleted!');
        }
        
    }

    public function edit($id)
    {
        return redirect()->route('user.address.edit', ['id' => $id]);
    }

    public function setDefault($id, AddressService $user)
    {
        $user->setUserAddressBook($id);
        $this->successAlert('Default Address Updated Successfully');
        $this->emit('updateComponent');
    }
}
