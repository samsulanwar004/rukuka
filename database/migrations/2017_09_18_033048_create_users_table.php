<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 150)->index();
            $table->string('password', 150)->nullable();
            $table->string('first_name', 200)->nullable();
            $table->string('last_name', 200)->nullable();
            $table->string('avatar')->nullable();
            $table->string('phone_number')->nullable();
            $table->date('dob')->index()->nullable();
            $table->string('gender', 1)->index();
            $table->string('bank_name', 10)->nullable()->index();
            $table->string('bank_account_name', 150)->nullable()->index();
            $table->string('bank_account_number', 15)->nullable()->index();
            $table->string('bank_branch', 15)->nullable()->index();
            $table->string('social_media_type')->nullable();
            $table->string('social_media_id')->nullable();            
            $table->string('remember_token', 100)->nullable();
            $table->boolean('status')->default(0);
            $table->timestamp('last_login')->nullable();
            $table->boolean('is_verified')->default(0);
            $table->string('verification_token', 60)->nullable();
            $table->timestamp('verification_expired')->nullable();           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
