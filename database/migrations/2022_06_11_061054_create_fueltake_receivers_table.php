<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFueltakeReceiversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fueltake_receivers', function (Blueprint $table) {
            $table->id();
            $table->string('id_activity');
            $table->string('id_stock');
            $table->string('material');
            $table->string('receiver');
            $table->date('date');
            $table->string('qty');
            $table->string('unit');
            $table->string('device_receiver');
            $table->time('hour_receiver');
            $table->string('server_receiver');
            $table->string('location');
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
        Schema::dropIfExists('fueltake_receivers');
    }
}
