<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('land_owners', function (Blueprint $table) {
            $table->id();
            $table->string('id_land');
            $table->string('owner');
            $table->string('land');
            $table->string('status_land');
            $table->string('royalty');
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
        Schema::dropIfExists('land_owners');
    }
}
