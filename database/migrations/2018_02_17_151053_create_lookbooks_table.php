<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLookbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('lookbooks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150)->unique();
            $table->string('slug', 150)->unique()->nullable();
            $table->text('title')->nullable();
            $table->text('subtitle')->nullable();
            $table->text('content')->nullable();
            $table->string('banner')->nullable();
            $table->string('order',7)->default(0)->nullable();;
            $table->string('is_active', 7)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('lookbook_collections', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('lookbooks_id');
            $table->string('name', 150)->unique();
            $table->string('slug', 150)->unique()->nullable();
            $table->text('title')->nullable();
            $table->text('subtitle')->nullable();
            $table->text('content')->nullable();
            $table->string('photo')->nullable();
            $table->string('order',7)->default(0)->nullable();;
            $table->string('is_active', 7)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('lookbooks_id', 'FK_lookbooks_id_on_lookbooks')
                ->references('id')->on('lookbooks')
                ->onUpdate('NO ACTION')->onDelete('NO ACTION');

        });

        Schema::create('lookbook_products', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('lookbook_collections_id');
            $table->unsignedInteger('products_id');

            $table->foreign('lookbook_collections_id', 'FK_lookbook_collections_id_on_lookbook_collections')
                ->references('id')->on('lookbook_collections')
                ->onUpdate('NO ACTION')->onDelete('NO ACTION');

            $table->foreign('products_id', 'FK_products_id_on_products')
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
