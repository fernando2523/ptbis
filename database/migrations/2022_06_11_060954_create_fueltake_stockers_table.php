<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFueltakeStockersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fueltake_stockers', function (Blueprint $table) {
            $table->id();
            $table->string('id_activity');
            $table->string('id_stock');
            $table->string('material');
            $table->string('stocker');
            $table->date('date');
            $table->string('qty');
            $table->string('unit');
            $table->string('device_stocker');
            $table->time('hour_stocker');
            $table->string('server_stocker');
            $table->string('pic');
            $table->string('vehicle');
            $table->string('retur');
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
        Schema::dropIfExists('fueltake_stockers');
    }
}
