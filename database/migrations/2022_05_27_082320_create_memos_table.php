<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memos', function (Blueprint $table) {
            // unsigned(±なし)にしないと外部キー制約に使えないのでid周りは全てunsignedをつける
            // 第二引数 trueはauto incrementの意
            $table->unsignedBigInteger('id', true);
            $table->longText('content');
            $table->unsignedBigInteger('user_id');
            // 論理削除を定義→deleted_atを自動生成
            $table->softDeletes();
            // timestampと書いてしまうと、レコード挿入時、更新時に値が入らないので、DB::rawで直接書いてます
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('memos');
    }
};
