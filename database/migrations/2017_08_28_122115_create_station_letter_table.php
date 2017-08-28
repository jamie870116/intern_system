<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStationLetterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('station_letter', function (Blueprint $table) {
            $table->increments('slId');//AI
            $table->tinyInteger('lStatus')->default(0);//信件種類
            $table->string('lSender',50)->default('系統');//寄件人帳號
            $table->string('lRecipient',50);//收件人帳號
            $table->string('lTitle',100);//標題
            $table->longText('lContent')->nullable();//信件內容
            $table->JSON('lNotes')->nullable();//信件備註(給前端參數用)
            $table->boolean('read')->default(false);//是否已讀
            $table->boolean('favourite')->default(false);//我的最愛
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
        Schema::dropIfExists('station_letter');
    }
}
