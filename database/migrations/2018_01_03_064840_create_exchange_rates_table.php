<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExchangeRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchange_rates', function (Blueprint $t) {
            $t->increments('id');
            $t->unsignedInteger('cms_users_id');
            $t->string('currency_code_from', 3);
            $t->string('currency_code_to', 3);
            $t->float('conversion_value');
            $t->float('inverse_conversion_value');
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exchange_rates');
    }
}
