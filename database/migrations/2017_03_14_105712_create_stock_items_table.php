<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('buying_tax')->unsigned()->nullable()->index();
            $table->integer('selling_tax')->unsigned()->nullable()->index();
            $table->integer('credit_note_tax')->unsigned()->nullable()->index();
            $table->string('code')->unique();
            $table->string('barcode')->unique();
            $table->string('name');
            $table->text('description');
            $table->float('unit_cost');
            $table->timestamps();

            $table->foreign('buying_tax')
                ->references('id')
                ->on('taxes')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->foreign('selling_tax')
                ->references('id')
                ->on('taxes')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->foreign('credit_note_tax')
                ->references('id')
                ->on('taxes')
                ->onDelete('set null')
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
        Schema::dropIfExists('stock_items');
    }
}
