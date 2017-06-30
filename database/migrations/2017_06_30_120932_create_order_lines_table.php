<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_lines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_id')->index()->unsigned();
            $table->integer('stock_item_id')->index()->unsigned();
            $table->integer('stall_id')->index()->unsigned()->nullable();
            $table->string('code');
            $table->string('name');
            $table->text('description');
            $table->integer('uom')->index()->unsigned();
            $table->integer('order_quantity');
            $table->integer('processed_quantity');
            $table->integer('tax_id')->index()->unsigned();
            $table->double('tax_rate');
            $table->double('unit_tax');
            $table->double('unit_exclusive');
            $table->double('unit_inclusive');
            $table->double('discount');
            $table->double('total_exclusive');
            $table->double('total_inclusive');
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('stock_item_id')->references('id')->on('stock_items')->onDelete('cascade');
            $table->foreign('stall_id')->references('id')->on('stalls')->onDelete('cascade');
            $table->foreign('uom')->references('id')->on('unit_of_measures')->onDelete('cascade');
            $table->foreign('tax_id')->references('id')->on('taxes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_lines');
    }
}
