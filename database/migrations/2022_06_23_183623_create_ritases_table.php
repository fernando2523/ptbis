<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRitasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ritases', function (Blueprint $table) {
            $table->id();
            $table->string('id_ritase');
            $table->string('departure_ts');
            $table->string('arrival_ts');
            $table->string('identify');
            $table->string('model_unit');
            $table->string('operator');
            $table->string('material');
            $table->string('departure_location');
            $table->string('arrival_location');
            $table->string('bucket');
            $table->string('type_activity');
            $table->string('origin');
            $table->string('id_form');
            $table->string('id_barg');
            $table->string('no_contract')->nullable(true);
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
        Schema::dropIfExists('ritases');
    }
}
