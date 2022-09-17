<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_histories', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_id');
            $table->string('vehicle_unit');
            $table->string('operator');
            $table->string('days')->nullable(true);
            $table->string('status');
            $table->string('contract');
            $table->string('price');
            $table->string('users');
            $table->string('path')->nullable(true);
            $table->string('model_unit');
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
        Schema::dropIfExists('vehicle_histories');
    }
}
