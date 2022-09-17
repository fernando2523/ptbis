<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBargingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bargings', function (Blueprint $table) {
            $table->id();
            $table->string('id_barg');
            $table->string('loc');
            $table->string('capacity');
            $table->string('stock');
            $table->string('status');
            $table->dateTime('start');
            $table->dateTime('finish')->nullable(true);
            // $table->string('id_vendor')->nullable(true);
            // $table->string('vendor')->nullable(true);
            $table->string('ni')->nullable(true);
            $table->string('fe')->nullable(true);
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
        Schema::dropIfExists('bargings');
    }
}
