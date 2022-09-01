<?php

namespace App\Console\Commands;

use App\Models\ProductInventory;

use Illuminate\Console\Command;

class SetProductInventoryStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'change:product-inventory-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change the status for product inventory';

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
        $product_inventories = ProductInventory::join('products', 'product_inventory.product_id', '=', 'products.id')->get();

            foreach($product_inventories as $product_inventory){
                ProductInventory::find($product_inventory->id)
                    ->update(['status' => $product_inventory->quantity <= $product_inventory->reorder_level ? 'REORDER' : 'ACTIVE']);
            }

        $this->info('Product Inventory Status Updated Successfully!');
    }
}
