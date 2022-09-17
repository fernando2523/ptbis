<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBargingDraftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barging_drafts', function (Blueprint $table) {
            $table->id();
            $table->string('id_barg');
            $table->string('id_vendor');
            $table->string('no_contract');
            $table->string('ritase');
            $table->string('bucket');
            $table->string('tonase');
            $table->string('ket')->nullable();
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
        Schema::dropIfExists('barging_drafts');
    }
}
