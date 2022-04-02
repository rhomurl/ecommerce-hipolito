<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Livewire\Component;

class Testupload extends Component
{
    use WithFileUploads;
    
    public $photo, $cp;

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:1024',
        ]);
    }

    public function render()
    {
        //$all_roles_in_database = Role::all()->pluck('name');
        $user = User::findorFail(2);
        
        $role = Role::findOrFail(2);
        //$this->user_id = $id;
        $name = $role->name;
        //$user->removeRole($name);
        //$user->assignRole('customer');
        //dd($user->getRoleNames());

        /*$cart = OrderProduct::select("product_id", DB::raw("sum(quantity) as product_qty"))
                        ->groupBy('product_id')
                        ->get();
                
        foreach ($cart as $cartProduct){
            Product::find($cartProduct->product_id)->decrement('quantity', $cartProduct->product_qty);
        }
        */

        /*$students = OrderProduct::join('products', 'order_product.product_id', '=', 'product.id')
                        ->select('products.*')
                        ->get();

        echo "<pre>";
        print_r($students);
        echo "</pre>";
        */
        //$cart = OrderProduct::with('product')->where('')->get();
        //$date = Carbon::now()->subDays(3);
        //$users = User::where('created_at', '>=', $date)->get();


        return view('livewire.testupload', compact('user'))->layout('layouts.admin');
    }

}