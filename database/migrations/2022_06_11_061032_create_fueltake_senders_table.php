<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFueltakeSendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fueltake_senders', function (Blueprint $table) {
            $table->id();
            $table->string('id_activity');
            $table->string('id_stock');
            $table->string('material');
            $table->string('sender');
            $table->date('date');
            $table->string('qty');
            $table->string('unit');
            $table->string('device_sender');
            $table->time('hour_sender');
            $table->string('server_sender');
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
        Schema::dropIfExists('fueltake_senders');
    }
}
