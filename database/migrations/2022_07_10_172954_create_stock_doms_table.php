<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockDomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_doms', function (Blueprint $table) {
            $table->id();
            $table->string('id_dom');
            $table->string('date');
            $table->string('code_sample');
            $table->string('id_location');
            $table->string('location');
            $table->string('bucket');
            // $table->string('ni');
            // $table->string('fe');
            $table->string('device');
            $table->string('users');
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
        Schema::dropIfExists('stock_doms');
    }
}
