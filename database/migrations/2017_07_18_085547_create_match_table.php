<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match', function (Blueprint $table) {
            $table->increments('mid'); //AI
            $table->integer('sid'); //學生ID
            $table->string('c_account',50); //廠商帳號
            $table->integer('joid'); //職缺ID
            $table->string('jduties',300);//職務
            $table->longText('jdetails');//職務詳細 /薪水 必備條件 工作內容 特殊要求
            $table->tinyInteger('mstatus')->default(1); //媒合狀態
            $table->integer('tid')->nullable(); //老師ID(系辦給；如果為空值，代表系辦未審核，成功才可輸入tid)
            $table->longText('mfailedreason')->nullable();//如果不為空值代表審核失敗，可供日後追蹤
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
        Schema::dropIfExists('match');
    }
}
