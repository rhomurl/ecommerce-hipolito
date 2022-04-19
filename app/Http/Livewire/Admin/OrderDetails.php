<?php

namespace App\Http\Livewire\Admin;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Order;
use App\Models\AddressBook;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Traits\ModelComponentTrait;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

//use App\Notifications\OrderConfirmation;

//use Illuminate\Notifications\Notifiable;
use Livewire\Component;

class OrderDetails extends Component
{
    use LivewireAlert;
    use ModelComponentTrait;

    public $order_id, $order_status, $status;

    public function mount($order_id)
    {
        $this->order_id = $order_id;
    }

    public function render()
    {
        $order = Order::findorFail($this->order_id);
    
        $address = AddressBook::with('barangay.city')->where('id', $order->address_book_id)->first();
        

        return view('livewire.admin.order-details', compact('order', 'address'))->layout('layouts.admin');
    }

    public function cancelStatus(){
        $this->status = false;
    }

    public function changeStatus1(){
        $this->status = true;
    }

    public function changeStatus2(){
        $this->status = false;

        if($this->order_status){
            $category = Order::updateOrCreate(
                ['id' => $this->order_id],
                ['status' => $this->order_status]
            );
    
            $category = Transaction::updateOrCreate(
                ['order_id' => $this->order_id],
                ['status' => $this->order_status]
            );
        }

        /*if($this->order_status == 'otw'){
            $order = Order::findorFail($this->order_id);
            $user = User::where('id', $order->user_id)->first();
        
            $orderData = [
                'greeting' => 'You order is on the way!',
                'name' => 'Hello ' . $user->firstname . ',',
                'body' => ' We are glad that your order #' . $order->id . ' ordered on ' . $order->created_at->format('F j Y h:i A') . ' is on the way. Kindly prepare an amount of '. $order->total .' PHP and your payment method is Cash on Delivery. Thank you for choosing our store!' ,
                'orderText' => 'View Order',
                'orderDetails' => [
                    'id' => $order->id . " - On The Way",
                ],
                'url' => url(route('user.order.details', $order->id )),
                'thankyou' => ''
            ];

            $user->notify(new OrderConfirmation($orderData));
        }*/
        $this->alert('success', 'Order Updated Successfully', [
            'position' => 'center',
            'timer' => '1500',
            'toast' => false,
            'timerProgressBar' => true,
           ]);
            //session()->flash('message', 'Order Updated Successfully');
        
    }
}
