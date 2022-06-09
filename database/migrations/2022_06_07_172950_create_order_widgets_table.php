<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderWidgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_widgets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('widget_id');
            $table->foreignUuid('order_id');
            $table->string('status')->default('pending');
            $table->timestamps();
        });

        Schema::table('order_widgets', function (Blueprint $table) {
            $table->foreign('widget_id')->references('id')->on(\App\Models\Widget::table());
            $table->foreign('order_id')->references('id')->on(\App\Models\Order::table())->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_widgets');
    }
}
