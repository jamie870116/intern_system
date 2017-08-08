<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJournalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journal', function (Blueprint $table) {

            $table->increments('journalID');//AI
            $table->integer('SCid');//課程老師學生廠商連結
            $table->integer('journalOrder');//日誌結束日期
            $table->longText('journalDetail_1');//重要事件紀錄與觀察
            $table->longText('journalDetail_2');//觀察心得與個人看法
            $table->dateTime('journalStart');//日誌開始日期
            $table->dateTime('journalEnd');//日誌結束日期
            $table->string('journalInstructor',100);//企業指導員姓名
            $table->longText('journalComments_ins');//企業指導員評語
            $table->longText('journalComments_teacher');//老師評語
            $table->integer('grade_ins');//企業評分
            $table->integer('grade_teacher');//老師評分

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
        Schema::dropIfExists('course');
    }
}
