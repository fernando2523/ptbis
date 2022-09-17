<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets_history', function (Blueprint $table) {
            $table->id();
            $table->string('id_stock');
            $table->string('id_transaction');
            $table->date('date');
            $table->string('material');
            $table->string('ket');
            $table->string('qty');
            $table->string('unit');
            $table->string('price');
            $table->string('total_price');
            $table->string('users');
            $table->string('desc')->nullable(true);
            $table->string('type_asset');
            $table->string('in_out')->nullable(true);
            $table->string('supplier');
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
        Schema::dropIfExists('assets_history');
    }
}
