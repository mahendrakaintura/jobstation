<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            // セッションID (varchar(255))
            $table->string('id', 255)->primary();

            // ユーザーID (bigint unsigned)
            $table->unsignedBigInteger('user_id')->nullable();

            // IPアドレス (varchar(45))
            $table->string('ip_address', 45)->nullable();

            // ユーザーエージェント (text)
            $table->text('user_agent')->nullable();

            // ペイロード (longtext)
            $table->longText('payload');

            // 最終アクティビティのタイムスタンプ (int)
            $table->integer('last_activity');

            // インデックス設定
            $table->index('user_id');
            $table->index('last_activity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sessions');
    }
}
