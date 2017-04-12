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
            $table->boolean('has_conversions')->default(false);
            $table->integer('stocking_uom')->unsigned()->nullable()->index();
            $table->integer('selling_uom')->unsigned()->nullable()->index();
            $table->string('code')->unique();
            $table->string('barcode')->unique()->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->float('unit_cost');
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
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

            $table->foreign('stocking_uom')
                ->references('id')
                ->on('unit_of_measures')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('selling_uom')
                ->references('id')
                ->on('unit_of_measures')
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
