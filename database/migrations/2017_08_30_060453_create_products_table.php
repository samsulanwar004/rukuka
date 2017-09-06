<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_designers', function (Blueprint $t) {
            $t->increments('id');
            $t->string('name', 150)->unique();
            $t->string('slug', 150)->unique();
            $t->text('content')->nullable();
            $t->string('banner')->nullable();
            $t->string('photo')->nullable();
            $t->timestamps();
            $t->softDeletes();
        });

        Schema::create('product_categories', function (Blueprint $t) {
            $t->increments('id');
            $t->unsignedInteger('parent_product_categories_id')->default(0);
            $t->string('name', 50)->unique();
            $t->string('slug', 80)->unique();
            $t->timestamps();
        });

        Schema::create('products', function (Blueprint $t) {
            $t->increments('id');            
            $t->unsignedInteger('product_designers_id');
            $t->unsignedInteger('product_categories_id');
            $t->string('product_code', 20)->unique();
            $t->string('name', 100);
            $t->string('color', 100);
            $t->string('slug', 150)->unique()->nullable();
            $t->text('content')->nullable();
            $t->text('detail_and_care')->nullable();
            $t->text('size_and_fit')->nullable();
            $t->text('technical_specification')->nullable();
            $t->string('currency', 4)->index()->default('USD');
            $t->bigInteger('price')->default(0);
            $t->bigInteger('sell_price')->default(0);
            $t->integer('diskon')->default(0);
            $t->string('is_active', 7)->nullable();
            $t->string('tags', 255)->nullable();
            $t->timestamps();
            $t->softDeletes();

            $t->foreign('product_designers_id', 'FK_product_designers_id_on_products')
              ->references('id')->on('product_designers')
              ->onUpdate('NO ACTION')->onDelete('NO ACTION');

            $t->foreign('product_categories_id', 'FK_product_categories_id_on_products')
              ->references('id')->on('product_categories')
              ->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::create('product_images', function(Blueprint $t) {
            $t->increments('id');
            $t->unsignedInteger('products_id');
            $t->string('name', 150)->nullable();
            $t->string('photo', 150)->nullable();


            $t->foreign('products_id', 'FK_products_id_on_product_images')
              ->references('id')->on('products')
              ->onUpdate('NO ACTION')->onDelete('NO ACTION');

        });

        Schema::create('product_stocks', function(Blueprint $t) {
            $t->increments('id');
            $t->unsignedInteger('products_id');
            $t->string('sku', 150)->unique();
            $t->string('size', 20)->nullable();
            $t->float('unit')->default(0);


            $t->foreign('products_id', 'FK_products_id_on_product_stocks')
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
        Schema::dropIfExists('product_designers');
        Schema::dropIfExists('product_categories');
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_stocks');
    }
}
