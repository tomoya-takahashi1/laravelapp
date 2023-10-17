<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToHomesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('homes', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(); // user_id カラムを追加し、nullable として NULL 値を許可
            $table->foreign('user_id')->references('id')->on('users'); // 外部キー制約を追加
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('homes', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // 外部キー制約を削除
            $table->dropColumn('user_id'); // user_id カラムを削除
        });
    }
}
