<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProductIdInWishlistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('wishlists', function (Blueprint $table) {
            $table->unsignedInteger('products_id')->after('id');
            $table->dropForeign('FK_product_stocks_id_on_wishlists');
            $table->dropColumn('product_stocks_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wishlists', function (Blueprint $table) {
            $table->dropColumn('products_id');
        });
    }
}
