<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePopulars extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('populars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('group_setting');
            $table->unsignedInteger('products_id');
            $table->unsignedInteger('order');
            $table->timestamps();
            $table->foreign('products_id', 'FK_products_id_on_popular')
                ->references('id')->on('products')
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
