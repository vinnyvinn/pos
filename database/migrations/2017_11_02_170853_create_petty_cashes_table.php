<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePettyCashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petty_cashes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('petty_cash_type_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->double('amount');
            $table->string('reference');
            $table->string('remarks');
            $table->timestamps();

            $table->foreign('petty_cash_type_id')->references('id')->on('petty_cash_types');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('petty_cashes');
    }
}
