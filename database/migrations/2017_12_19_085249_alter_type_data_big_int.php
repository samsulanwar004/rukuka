<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTypeDataBigInt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->float('price')->change();
            $table->float('sell_price')->change();
            $table->float('price_before_discount')->nullable()->change();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->float('order_subtotal')->change();
            $table->float('order_subtotal_after_discount')->change();
            $table->float('order_subtotal_after_coupon')->change();
            $table->float('shipping_cost')->change();
        });

        Schema::table('order_details', function (Blueprint $table) {
            $table->float('price')->change();
            $table->float('subtotal')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
