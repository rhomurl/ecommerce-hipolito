<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Transaction;
use DB;

use Illuminate\Console\Command;

class CancelOrderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cancel:order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cancel Unpaid Orders';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $order_pending = Order::where('status', 'pending')
            ->where('created_at', '<=', now()->subMinutes(60)->toDateTimeString())
            ->get();

        foreach($order_pending as $pending){
            $cart = OrderProduct::select("product_id", DB::raw("sum(quantity) as product_qty"))
                ->groupBy('product_id')
                ->where('order_id', $pending->id)
                ->get();

            foreach($cart as $cartProduct){
                Product::find($cartProduct->product_id)
                    ->increment('quantity', $cartProduct->product_qty);
            }

            $order = Order::find($pending->id);
            $order->status = 'cancelled';
            $order->save();

            $transaction = Transaction::where('order_id', '=', $pending->id)
                ->update(array('status' => 'cancelled'));
        }
        $this->info('Unpaid Order Succesfully Cancelled!');
    }
}
