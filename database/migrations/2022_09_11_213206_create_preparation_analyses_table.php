<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreparationAnalysesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preparation_analyses', function (Blueprint $table) {
            $table->id();
            $table->string('id_analysis');
            $table->string('date');
            $table->string('code_sample_final');
            $table->string('ni')->nullable(true);
            $table->string('fe')->nullable(true);
            $table->string('increment')->nullable(true);
            $table->string('desc')->nullable(true);
            $table->string('users');
            $table->string('path')->nullable(true);
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
        Schema::dropIfExists('preparation_analyses');
    }
}
