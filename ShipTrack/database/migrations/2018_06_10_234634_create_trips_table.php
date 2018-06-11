<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('truck_id');
            $table->integer('order_id');
            $table->integer('employee_id');
            $table->datetime('start_time');
            $table->datetime('delivery_time');
            $table->double('current_lat');
            $table->double('current_long');
            $table->enum('status', ['On Route', 'Delayed','Cancelled', 'Delivered']);
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
        Schema::dropIfExists('trips');
    }
}
