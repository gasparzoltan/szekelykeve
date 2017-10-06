<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('key')->unique();
            $table->string('image')->nullable();
            $table->text('content')->nullable();
            $table->boolean('highlighted')->default(0);

            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')
              ->references('id')->on('categories')
              ->onUpdate('cascade')
              ->onDelete('restrict');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
              ->references('id')->on('users')
              ->onUpdate('cascade')
              ->onDelete('restrict');              

            $table->timestamp('published_at')->nullable();
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
        Schema::dropIfExists('articles');
    }
}
