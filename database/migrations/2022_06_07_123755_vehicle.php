<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Vehicle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_id');
            $table->string('vehicle_unit');
            $table->string('operator');
            $table->string('type_unit');
            $table->string('type_vehicle');
            $table->string('users');
            $table->string('model_unit');
            $table->string('status');
            $table->string('id_vendor')->nullable(true);
            $table->string('no_contract')->nullable(true);
            $table->string('vendor')->nullable(true);
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
        Schema::dropIfExists('vehicle');
    }
}
