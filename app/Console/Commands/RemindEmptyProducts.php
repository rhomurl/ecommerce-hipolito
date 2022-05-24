<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Product;
use App\Notifications\EmptyProductNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Console\Command;

class RemindEmptyProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:no-stock-product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify admin via Email for out of stock products.';

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
        $admins = User::role(['admin','super-admin'])->get();

        $empty_product = Product::where('quantity', 0)->get();
        foreach($empty_product as $empty){
            $productData = [
                'name' => 'Hello admin!',
                'product_name' => $empty->name ,
                'product_id' => 69
               // 'url' => url(route('user.order.details', $order->uuid )),
            ];

        foreach($admins as $admin){
                $admin->notify(new EmptyProductNotification($productData));
            }
        }
        $this->info('Email Sent to Admin!');
        //return 0;
    }
}
