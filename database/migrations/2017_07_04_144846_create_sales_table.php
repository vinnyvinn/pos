<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('unit_conversion_id');
            $table->string('uom');
            $table->string('stock_item_id');
            $table->integer('stock_name');
            $table->string('quantity');
            $table->string('unitExclPrice');
            $table->string('unitInclPrice');
            $table->string('totalInclPrice');
            $table->string('totalExclPrice');
            $table->string('total_tax');
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
        Schema::dropIfExists('sales');
    }
}
