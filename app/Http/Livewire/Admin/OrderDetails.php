<?php

namespace App\Http\Livewire\Admin;

use App\Models\{Transaction, User, Order, AddressBook};
use App\Notifications\OrderNotification;
use App\Services\OrderService;
use App\Traits\ModelComponentTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class OrderDetails extends Component
{
    use LivewireAlert;
    use ModelComponentTrait;

    public $order_id, $order_status, $status;

    public function mount(Order $order)
    {
        $this->order_id = $order->id;
    }

    public function render()
    {
        $order = Order::findorFail($this->order_id);
        $address = AddressBook::with('barangay.city')->where('id', $order->address_book_id)->first();
        return view('livewire.admin.order-details', compact('order', 'address'))->layout('layouts.admin');
    }

    public function viewPaypal($id)
    {
        $this->emit("openModal", "admin.order-paypal", ["id" => $id]);
    }

    public function cancelStatus(){ $this->status = false; }
    public function changeStatus1(){ $this->status = true; }

    public function changeStatus2(){
        $this->status = false;

        if($this->order_status){
            Order::updateOrCreate(['id' => $this->order_id],['status' => $this->order_status]);
            Transaction::updateOrCreate(['order_id' => $this->order_id],['status' => $this->order_status]);
        }

        if($this->order_status == 'otw'){
            $order = Order::findorFail($this->order_id);
            $user = User::where('id', $order->user_id)->first();
        
            $orderData = resolve(OrderService::class)->orderDetailsDelivery($order, $user);

            $user->notify(new OrderNotification($orderData));
        }

        $this->successAlert('Order Updated Successfully!');
    }

    public function redirectTo($route){
        return redirect()->route($route, 'all');
    }
}
