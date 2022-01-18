<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_book', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('entry_company', 64)->nullable();
            $table->string('entry_firstname', 32);
            $table->string('entry_lastname', 32);
            $table->string('entry_street_address', 64);
            $table->string('entry_landmark', 128);
            $table->foreignId('barangay_id')->constrained('barangays');
            $table->string('entry_phonenumber', 16);     
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
        Schema::dropIfExists('address_book');
    }
}
