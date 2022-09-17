<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockCargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_cargos', function (Blueprint $table) {
            $table->id();
            $table->string('id_cargo');
            $table->string('id_location')->nullable(true);
            $table->string('loc')->nullable(true);
            $table->string('category');
            $table->string('estimated')->nullable(true);
            $table->string('in_bucket')->nullable(true);
            $table->string('in_ritase')->nullable(true);
            $table->string('in_volume_bucket')->nullable(true);
            $table->string('out_bucket')->nullable(true);
            $table->string('out_ritase')->nullable(true);
            $table->string('out_volume_bucket')->nullable(true);
            $table->string('status');
            $table->string('dome');
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
        Schema::dropIfExists('stock_cargos');
    }
}
