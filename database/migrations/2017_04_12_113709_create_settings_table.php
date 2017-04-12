<?php

use App\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('inventory_control_method')->default(Setting::NONE);
            $table->string('costing_method')->default(Setting::LATEST_COSTING);
            $table->boolean('enable_loyalty')->default(false);
            $table->boolean('enable_gift_cards')->default(false);
            $table->boolean('enable_bundles')->default(false);
            $table->boolean('enable_happy_hour_sales')->default(false);
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
        Schema::dropIfExists('settings');
    }
}
