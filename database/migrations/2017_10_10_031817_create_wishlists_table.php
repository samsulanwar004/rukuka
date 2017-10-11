<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWishlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wishlists', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('users_id');
            $table->unsignedInteger('product_stocks_id');
            $table->text('content')->nullable();
            $table->timestamps();

            $table->foreign('users_id', 'FK_users_id_on_wishlists')
              ->references('id')->on('users')
              ->onUpdate('NO ACTION')->onDelete('NO ACTION');

            $table->foreign('product_stocks_id', 'FK_product_stocks_id_on_wishlists')
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
        Schema::dropIfExists('wishlists');
    }
}
