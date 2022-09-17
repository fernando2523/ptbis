<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RitasesDeparture extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ritases_departure', function (Blueprint $table) {
            $table->id();
            $table->string('id_unit');
            $table->string('identity');
            $table->string('id_location');
            $table->string('location');
            $table->string('bucket');
            $table->string('operator');
            $table->string('material');
            $table->string('device');
            $table->string('users');
            $table->string('server');
            $table->string('tipe_ritase');
            $table->string('origin');
            $table->string('id_form');
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
        Schema::dropIfExists('ritases_departure');
    }
}
