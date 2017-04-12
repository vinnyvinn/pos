<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriceListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('price_list_name_id')->unsigned()->index();
            $table->integer('stock_item_id')->unsigned()->index();
            $table->integer('unit_conversion_id')->unsigned()->index()->nullable();
            $table->float('inclusive_price');
            $table->float('exclusive_price');
            $table->float('tax');
            $table->timestamps();

            $table->foreign('price_list_name_id')
                ->references('id')
                ->on('price_list_names')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('stock_item_id')
                ->references('id')
                ->on('stock_items')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('unit_conversion_id')
                ->references('id')
                ->on('unit_of_measures')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('price_lists');
    }
}
