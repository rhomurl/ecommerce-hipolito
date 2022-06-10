<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use App\Models\AddressBook;
use App\Services\AddressService;
use App\Traits\ModelComponentTrait;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
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
            AddressBook::findOrFail($id)->delete();
            
            $user = User::find(Auth::user()->id);
            $user->address_book_id = 0;
            $user->save();

            $this->successToast('Address Deleted Successfully!');
            
        } catch(\Illuminate\Database\QueryException $exception){
            $this->errorAlert('This Address Cannot Be Deleted!');
        } catch(\Exception $exception){
            //dd(get_class($exception));
            //
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
