<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stock_item_id')->unsigned()->nullable();
            $table->integer('transaction_type_id')->unsigned()->nullable();
            $table->integer('stall_id')->unsigned()->nullable();
            $table->integer('sale_id')->unsigned()->nullable();
            $table->integer('unit_conversion_id')->unsigned()->nullable();
            $table->string('stock_name');
            $table->string('code');
            $table->string('description')->nullable();
            $table->double('quantity');
            $table->double('weight');
            $table->double('tax_rate');
            $table->double('unit_tax')->default(0);
            $table->double('discount')->default(0);
            $table->string('unitExclPrice');
            $table->string('unitInclPrice');
            $table->string('totalInclPrice');
            $table->string('totalExclPrice');
            $table->string('total_tax');
            $table->timestamps();
            $table->boolean('synched')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
