<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBackendrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('backendr', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->string('accounthead');
            $table->string('description');
            $table->integer('debit');
            $table->integer('credit');
            $table->integer('cashbalance');
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
        Schema::dropIfExists('backendr');
    }
}