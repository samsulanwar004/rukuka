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
        Schema::create('orders', function (Blueprint $t) {
            $t->increments('id');            
            $t->unsignedInteger('users_id');
            $t->unsignedInteger('shipping_id')->nullable();
            $t->unsignedInteger('payment_id')->nullable();
            $t->string('order_code', 20)->unique();
            $t->string('payment_method', 100);
            $t->string('payment_name', 100);            
            $t->boolean('payment_status')->default(0);
            $t->boolean('payment_validation_status')->default(0);
            $t->boolean('order_status')->default(0);
            $t->bigInteger('order_subtotal')->default(0);
            $t->bigInteger('order_subtotal_after_discount')->default(0);
            $t->bigInteger('order_subtotal_after_coupon')->default(0);
            $t->bigInteger('shipping_cost')->default(0);
            $t->text('cancel_reason')->nullable();
            $t->text('pending_reason')->nullable();
            $t->datetime('order_date');
            $t->datetime('expired_date');
            $t->timestamps();
            $t->softDeletes();

            $t->foreign('users_id', 'FK_users_id_on_orders')
              ->references('id')->on('users')
              ->onUpdate('NO ACTION')->onDelete('NO ACTION');

            $t->foreign('shipping_id', 'FK_shipping_id_on_orders')
              ->references('id')->on('address')
              ->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::create('order_details', function(Blueprint $t) {
            $t->increments('id');
            $t->unsignedInteger('orders_id');
            $t->unsignedInteger('product_stocks_id');
            $t->string('product_code', 100)->nullable();
            $t->string('product_name', 100)->nullable();
            $t->string('sku', 150)->nullable();            
            $t->integer('qty')->default(1);
            $t->bigInteger('price')->default(0);
            $t->bigInteger('subtotal')->default(0);
            $t->timestamps();

            $t->foreign('orders_id', 'FK_orders_id_on_order_details')
              ->references('id')->on('orders')
              ->onUpdate('NO ACTION')->onDelete('NO ACTION');

            $t->foreign('product_stocks_id', 'FK_product_stocks_id_on_order_details')
              ->references('id')->on('product_stocks')
              ->onUpdate('NO ACTION')->onDelete('NO ACTION');

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
        Schema::dropIfExists('order_details');
    }
}
