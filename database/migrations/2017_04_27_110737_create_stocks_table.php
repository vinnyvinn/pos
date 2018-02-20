<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('stall_id')->unsigned()->index();
            $table->integer('item_id')->unsigned();
            $table->double('quantity_on_hand')->default(0);
            $table->double('quantity_reserved');
//            $table->string('sell_by')->default('Piece');
            $table->timestamps();

            $table->foreign('stall_id')->references('id')->on('stalls')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('stock_items')->onDelete('cascade');

            $table->boolean('synched')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
