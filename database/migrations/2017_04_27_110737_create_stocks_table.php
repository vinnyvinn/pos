<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('stall_id')->unsigned()->index();
            $table->integer('item_id')->unsigned();
            $table->double('quantity_on_hand')->default(0);
            $table->double('quantity_reserved');
            $table->timestamps();

            $table->foreign('stall_id')->references('id')->on('stalls')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('stock_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
