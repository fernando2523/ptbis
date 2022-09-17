<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FuelRefill extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuel_refill', function (Blueprint $table) {
            $table->id();
            $table->string('id_stock');
            $table->string('id_activity');
            $table->date('date');
            $table->time('hour');
            $table->string('material');
            $table->string('vehicle_id');
            $table->string('vehicle_unit');
            $table->string('operator');
            $table->string('qty');
            $table->string('unit');
            $table->string('stock_from');
            $table->string('location');
            $table->string('pic');
            $table->string('users');
            $table->string('device');
            $table->string('server');
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
        Schema::dropIfExists('fuel_refill');
    }
}
