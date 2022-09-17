<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RitasesArrival extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ritases_arrival', function (Blueprint $table) {
            $table->id();
            $table->string('id_unit');
            $table->string('identity');
            $table->string('id_location');
            $table->string('location');
            $table->string('device');
            $table->string('users');
            $table->string('server');
            $table->string('tipe_ritase');
            $table->string('id_form');
            $table->string('id_barg');
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
        Schema::dropIfExists('ritases_arrival');
    }
}
