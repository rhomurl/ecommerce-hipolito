<?php

namespace App\Http\Livewire\Admin;

use App\Models\{Product, Transaction, User, Order, OrderProduct, AddressBook};
use App\Notifications\OrderNotification;
use App\Services\OrderService;
use App\Traits\ModelComponentTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use DB;

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
            Order::updateOrCreate(['id' => $this->order_id],['status' => $this->order_status, 'admin_id' => auth()->user()->id]);
            Transaction::updateOrCreate(['order_id' => $this->order_id],['status' => $this->order_status]);
        }

        if($this->order_status == 'otw'){
            $order = Order::findorFail($this->order_id);
            $user = User::where('id', $order->user_id)->first();
        
            $orderData = resolve(OrderService::class)->orderDetailsDelivery($order, $user);

            $user->notify(new OrderNotification($orderData));
        }
        else if($this->order_status == 'cancelled'){
            $order_pending = Order::find($this->order_id);

                $cart = OrderProduct::select("product_id", DB::raw("sum(quantity) as product_qty"))
                    ->groupBy('product_id')
                    ->where('order_id', $this->order_id)
                    ->get();

                foreach($cart as $cartProduct){
                    Product::find($cartProduct->product_id)
                        ->increment('quantity', $cartProduct->product_qty);
                }

                $order = Order::find($this->order_id);
                $order->status = 'cancelled';
                $order->save();

                $transaction = Transaction::where('order_id', '=', $this->order_id)
                    ->update(array('status' => 'cancelled'));

        }

        $this->successAlert('Order Updated Successfully!');
    }

    public function redirectTo($route){
        return redirect()->route($route, 'all');
    }
}
