<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle__types', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_id');
            $table->string('type_vehicle');
            $table->string('mb')->nullable();
            $table->string('mt')->nullable();
            $table->string('dt')->nullable();
            $table->string('ex')->nullable();
            $table->string('dz')->nullable();
            $table->string('dte')->nullable();
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
        Schema::dropIfExists('vehicle__types');
    }
}
