<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfirmPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('confirm_payments', function(Blueprint $t) {
            $t->increments('id');
            $t->unsignedInteger('orders_id');
            $t->string('customer_bank', 100)->nullable();
            $t->string('account_owner', 100)->nullable();
            $t->string('store_bank', 100)->nullable();
            $t->bigInteger('transfer_amount')->default(0);
            $t->boolean('is_valid')->default(0);
            $t->timestamps();

            $t->foreign('orders_id', 'FK_orders_id_on_confirm_payments')
                ->references('id')->on('orders')
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
        //
    }
}
