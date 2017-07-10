<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('account_id')->index()->unsigned();
            $table->integer('user_id')->index()->unsigned()->nullable();
            $table->integer('stall_id')->index()->unsigned()->nullable();
            $table->tinyInteger('document_type');
            $table->tinyInteger('document_status');
            $table->string('document_number')->nullable();
            $table->string('order_number')->nullable();
            $table->string('external_order_number')->nullable();
            $table->text('description')->nullable();
            $table->date('order_date')->nullable();
            $table->date('due_date')->nullable();
            $table->double('total_discount')->default(0);
            $table->double('total_exclusive');
            $table->double('total_inclusive');
            $table->double('total_tax');
            $table->timestamps();
            $table->softDeletes();

            // $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            // $table->foreign('stall_id')->references('id')->on('stalls')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
