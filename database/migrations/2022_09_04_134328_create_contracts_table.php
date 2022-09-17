<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('no_contract');
            $table->string('id_vendor');
            $table->string('pic_vendor');
            $table->string('type_vendor');
            $table->string('name_product');
            $table->string('contract');
            $table->string('contract_agreement');
            $table->string('qty')->nullable(true);
            $table->string('amount');
            $table->string('total_amount')->nullable(true);
            $table->date('start_days');
            $table->date('end_days');
            $table->string('status');
            $table->string('payment')->nullable(true);
            $table->string('path')->nullable(true);
            $table->string('users');
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
        Schema::dropIfExists('contracts');
    }
}
