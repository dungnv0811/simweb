<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('slug')->unique()->index();
            $table->string('title', 100);
            $table->string('ward_code');
            $table->foreign('ward_code')->references('code')->on('wards')->onDelete('cascade');
            $table->unsignedInteger('branch_id', 100);
            $table->string('model', 100)->nullable();
            $table->float('price', 16, 2);
            $table->string('images');
            $table->string('short_description', 160);
            $table->longText('description');
            $table->tinyInteger('state')->default(0); // is it brand new or second hand
            $table->tinyInteger('status')->default(0);
            $table->boolean('is_recommended')->default(0);
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
        Schema::dropIfExists('posts');
    }
}
