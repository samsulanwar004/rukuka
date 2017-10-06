<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('address', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('users_id');
            $table->string('first_name', 200)->nullable();
            $table->string('last_name', 200)->nullable();
            $table->string('company', 200)->nullable();
            $table->string('address_line', 200)->nullable();
            $table->string('city', 200)->nullable();
            $table->string('province', 200)->nullable();
            $table->string('postal', 10)->nullable();
            $table->string('country', 200)->nullable();
            $table->string('phone_number', 200)->nullable();
            $table->boolean('is_default')->default(0);
            $table->timestamps();

            $table->foreign('users_id', 'FK_users_id_on_address')
              ->references('id')->on('users')
              ->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::create('credit_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('users_id');
            $table->unsignedInteger('address_id');
            $table->string('card_number', 20)->nullable();
            $table->string('expired_date', 10)->nullable();
            $table->string('name_card', 255)->nullable();
            $table->boolean('is_default')->default(0);
            $table->timestamps();

            $table->foreign('users_id', 'FK_users_id_on_credit_cards')
              ->references('id')->on('users')
              ->onUpdate('NO ACTION')->onDelete('NO ACTION');

            $table->foreign('address_id', 'FK_address_id_on_credit_cards')
              ->references('id')->on('address')
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
        Schema::dropIfExists('address');
        Schema::dropIfExists('credit_cards');
    }
}
