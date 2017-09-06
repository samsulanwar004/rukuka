<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomestaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homestay_owners', function (Blueprint $t) {
            $t->increments('id');
            $t->unsignedInteger('regencies_id');
            $t->string('name', 150)->nullable();
            $t->string('number_phone', 12)->nullable();
            $t->string('address')->nullable();
            $t->timestamps();
            $t->softDeletes();
        });

        Schema::create('amenities', function (Blueprint $t) {
            $t->increments('id');
            $t->string('name', 50)->unique();
            $t->string('icon')->nullable();
        });

        Schema::create('homestays', function (Blueprint $t) {
            $t->increments('id');     
            $t->unsignedInteger('homestay_owners_id');                  
            $t->string('homestay_code', 20)->unique();
            $t->string('name', 100);
            $t->string('slug', 150)->unique()->nullable();
            $t->integer('accommodates')->default(0);
            $t->integer('bedrooms')->default(0);
            $t->integer('bathrooms')->default(0);
            $t->integer('beds')->default(0);
            $t->string('currency', 4)->index()->default('USD');
            $t->bigInteger('price')->default(0);
            $t->text('cancellations')->nullable();
            $t->integer('availability')->default(0);            
            $t->string('latitude')->nullable();
            $t->string('longitude')->nullable();
            $t->string('address')->nullable();
            $t->text('descriptions')->nullable();
            $t->string('check_in_time', 20)->nullable();
            $t->string('check_out_time', 20)->nullable();            
            $t->string('safety_features', 255)->nullable();
            $t->string('house_rules', 255)->nullable();
            $t->string('is_active', 7)->nullable();
            $t->timestamps();
            $t->softDeletes();

            $t->foreign('homestay_owners_id', 'FK_homestay_owners_id_on_homestays')
              ->references('id')->on('homestay_owners')
              ->onUpdate('NO ACTION')->onDelete('NO ACTION');

        });

        Schema::create('homestay_images', function(Blueprint $t) {
            $t->increments('id');
            $t->unsignedInteger('homestays_id');
            $t->string('name', 150)->nullable();
            $t->string('photo', 150)->nullable();


            $t->foreign('homestays_id', 'FK_homestays_id_on_homestay_images')
              ->references('id')->on('homestays')
              ->onUpdate('NO ACTION')->onDelete('NO ACTION');

        });


        Schema::create('homestay_amenities', function(Blueprint $t) {
            $t->increments('id');
            $t->unsignedInteger('homestays_id');
            $t->unsignedInteger('amenities_id');

            $t->foreign('homestays_id', 'FK_homestays_id_on_homestay_amenities')
              ->references('id')->on('homestays')
              ->onUpdate('NO ACTION')->onDelete('NO ACTION');

              $t->foreign('amenities_id', 'FK_amenities_id_on_homestay_images')
              ->references('id')->on('amenities')
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
        Schema::dropIfExists('homestay_owners');
        Schema::dropIfExists('amenities');
        Schema::dropIfExists('homestays');
        Schema::dropIfExists('homestay_images');
        Schema::dropIfExists('homestay_amenities');
    }
}
