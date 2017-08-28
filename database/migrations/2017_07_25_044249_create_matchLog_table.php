<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matchLog', function (Blueprint $table) {
//            $table->increments('logid');//AI
//            $table->tinyInteger('mstatus')->default(0);//信件種類
//            $table->integer('mid')->nullable();//媒合編號
//            $table->string('mSender',50)->default('系統');//寄件人帳號
//            $table->string('mRecipient',50)->nullable();//收件人帳號
//            $table->string('mTitle',100)->nullable();//標題
//            $table->longText('miContent')->nullable();//信件內容
//            $table->date('mailDeadline')->nullable();//過期時間
//            $table->boolean('read')->default(false);//是否已讀
//            $table->boolean('favourite')->default(false);//我的最愛
//            $table->softDeletes();//軟刪除
//            $table->timestamps();//時間戳
            $table->increments('logid');//AI
            $table->tinyInteger('mstatus')->default(0);//信件種類
            $table->integer('mid');//媒合編號
            $table->softDeletes();//軟刪除
            $table->timestamps();//時間戳
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matchLog');
    }
}
