<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterviewComTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interview_com', function (Blueprint $table) {

            $table->increments('insCId');//AI
            $table->integer('SCid');//課程老師學生廠商連結
            $table->date('insCDate');//訪視日期
            $table->integer('insCNum');//進用實習生人數
            $table->string('insComName',30);//實習員姓名
            $table->string('insComTel',100);//電話
            $table->string('insAddress',200);//實習地址
            $table->tinyInteger('insCVisitWay')->default(0);//訪視方法
            $table->string('insCAns',500);//訪視答案，以逗點隔開
            $table->tinyInteger('insCQuestionVer')->default(1);//題目版本
            $table->string('insCComments',500);//評語
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
        Schema::dropIfExists('interview_com');
    }
}
