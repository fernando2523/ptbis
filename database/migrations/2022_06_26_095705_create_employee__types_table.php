<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee__types', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('type_user');
            $table->text('bsa')->nullable();
            $table->text('bse')->nullable();
            $table->text('bso')->nullable();
            $table->text('bsit')->nullable();
            $table->text('bsf')->nullable();
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
        Schema::dropIfExists('employee__types');
    }
}
