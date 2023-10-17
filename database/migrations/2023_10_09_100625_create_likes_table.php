<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('home_id');
            $table->timestamps();

            $table->unique(['user_id', 'home_id']); // ユーザーと投稿の組み合わせが一意であることを保証
        });
    }

    public function down()
    {
        Schema::dropIfExists('likes');
    }
}
