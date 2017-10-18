<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_categories', function (Blueprint $t) {
            $t->increments('id');
            $t->unsignedInteger('parent_blog_categories_id')->default(0);
            $t->string('name', 50);
            $t->string('slug', 80)->unique()->nullable();
            $t->timestamps();
        });

        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('blog_categories_id');
            $table->unsignedInteger('cms_users_id');
            $table->string('title', 255);
            $table->string('slug', 150)->unique()->nullable();
            $table->text('content')->nullable();
            $table->text('tags')->nullable();
            $table->boolean('read')->default(0);
            $table->boolean('is_publish')->default(0);
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
        Schema::dropIfExists('blog_categories');
        Schema::dropIfExists('blogs');
    }
}
