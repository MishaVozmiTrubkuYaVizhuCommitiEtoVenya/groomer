<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('working_diapason_start_id')->unsigned();
            $table->bigInteger('pet_id')->unsigned()->nullable();
            $table->string('phone',32)->nullable();
            $table->string('pet_name',128)->nullable();
            $table->string('owner_name',128)->nullable();
            $table->string('comment')->nullable();
            $table->string('email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
