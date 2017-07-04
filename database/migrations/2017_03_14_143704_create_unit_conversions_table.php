<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitConversionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_conversions', function (Blueprint $table) {
            $table->integer('stock_item_id')->index()->unsigned();
            $table->integer('stocking_unit_id')->index()->unsigned();
            $table->integer('converted_unit_id')->index()->unsigned();
            $table->float('stocking_ratio');
            $table->float('converted_ratio');
            $table->timestamps();

            $table->foreign('stocking_unit_id')
                ->references('id')
                ->on('unit_of_measures')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('converted_unit_id')
                ->references('id')
                ->on('unit_of_measures')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('stock_item_id')
                ->references('id')
                ->on('stock_items')
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
        Schema::dropIfExists('unit_conversions');
    }
}
