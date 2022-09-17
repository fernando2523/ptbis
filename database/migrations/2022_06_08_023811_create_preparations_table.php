<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreparationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preparations', function (Blueprint $table) {
            $table->id();
            $table->string('id_prepp');
            $table->string('id_dome');
            $table->date('date');
            $table->string('location');
            $table->string('code_sample');
            // $table->string('ni')->nullable(true);
            // $table->string('fe')->nullable(true);
            $table->string('code_sample_final')->nullable(true);
            $table->string('status')->nullable(true);
            $table->string('users');
            $table->string('device');
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
        Schema::dropIfExists('preparations');
    }
}
