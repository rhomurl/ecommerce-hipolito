<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_product', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            //category
            $table->foreignId('product_id')->constrained('products')->unique(); //noneditabled
            $table->string('supplier'); //editable
            $table->timestamp('received_at');
            $table->decimal('product_cost', 9, 2);
            //selling price
            //profit
            $table->unsignedInteger('starting_stock');
            //stock quantity 
            //inventory value
            $table->unsignedInteger('reorder_level');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_product');
    }
}
