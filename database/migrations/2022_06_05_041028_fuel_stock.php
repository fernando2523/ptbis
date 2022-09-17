<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FuelStock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuel_stock', function (Blueprint $table) {
            $table->id();
            $table->string('id_stock');
            $table->date('date');
            $table->string('material');
            $table->string('qty');
            $table->string('unit');
            $table->string('type_asset');
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
        Schema::dropIfExists('fuel_stock');
    }
}
