<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterviewStuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interview_stu', function (Blueprint $table) {

            $table->increments('insId');//AI
            $table->integer('SCid');//課程老師學生廠商連結
            $table->date('insDate');//訪視日期
            $table->integer('insNum');//進用實習生人數
            $table->string('insStuName',30);//student name
            $table->string('insStuClass',100);//student class
            $table->string('insAddress',200);//實習地址
            $table->tinyInteger('insVisitWay');//訪視方法
            $table->string('insAns',500);//訪視答案，以逗點隔開
            $table->tinyInteger('insQuestionVer');//題目版本
            $table->string('insComments',500);//評語
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
        Schema::dropIfExists('interview_stu');
    }
}
