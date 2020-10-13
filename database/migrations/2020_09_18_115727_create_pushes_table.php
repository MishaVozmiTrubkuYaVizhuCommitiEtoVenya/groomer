<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePushesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pushes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id')->unsigned();
            $table->string('text')->nullable();
            $table->string('title')->nullable();
            $table->string('icon')->nullable();
            $table->string('sound')->nullable();
            $table->string('description')->nullable();
            $table->string('platform')->nullable();
            $table->dateTime('date')->nullable();
            $table->string('device_token')->nullable();
            $table->boolean('is_sent')->default(false);

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
        Schema::dropIfExists('pushes');
    }
}
