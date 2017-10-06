<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicturesTable extends Migration
{

    public function up()
    {
        Schema::create('pictures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('article_key');
            $table->boolean('is_gallery_image')->default(0);
            $table->boolean('is_thumbnail_image')->default(0);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('pictures');
    }
}
