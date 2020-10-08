<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkingDiapasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('working_diapasons', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('master_id')->unsigned();
            $table->integer('size')->unsigned()->nullable();
            $table->dateTime('time_start');
            $table->tinyInteger('state');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('working_diapasons');
    }
}
