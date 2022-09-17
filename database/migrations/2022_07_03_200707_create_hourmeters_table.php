<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHourmetersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hourmeters', function (Blueprint $table) {
            $table->id();
            $table->string('id_hm');
            $table->string('date');
            $table->string('vehicle_unit');
            $table->string('identify');
            $table->string('operator');
            $table->string('type_unit');
            $table->string('hm_start')->nullable(true);
            $table->string('hm_finish')->nullable(true);
            $table->string('hm_total')->nullable(true);
            $table->string('activity');
            $table->string('location');
            $table->string('start');
            $table->string('finish')->nullable(true);
            $table->string('users');
            $table->string('device');
            $table->string('server');
            $table->string('no_conract')->nullable(true);
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
        Schema::dropIfExists('hourmeters');
    }
}
