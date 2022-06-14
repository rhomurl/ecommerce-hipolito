<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use App\Models\Order;
use App\Models\AddressBook;
use App\Services\AddressService;
use App\Traits\ModelComponentTrait;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Exceptions\AddressAttachedToOrderException;
use Livewire\Component;

class MyAddress extends Component
{
    use LivewireAlert;
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

    public function delete($id)
    {
        try{
            resolve(AddressService::class)->checkAddress($id);
            if(auth()->user()->address_book_id == $id){
                $user = User::find(auth()->user()->id);
                $user->address_book_id = 0;
                $user->save();
            }
            
            AddressBook::findOrFail($id)->delete();
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
        $this->emit('updateComponent');
    }
}
