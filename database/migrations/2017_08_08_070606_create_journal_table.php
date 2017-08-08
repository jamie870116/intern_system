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
            $table->longText('journalDetail_1')->nullable();//重要事件紀錄與觀察
            $table->longText('journalDetail_2')->nullable();//觀察心得與個人看法
            $table->dateTime('journalStart')->nullable();//日誌開始日期
            $table->dateTime('journalEnd')->nullable();//日誌結束日期
            $table->string('journalInstructor',100)->nullable();//企業指導員姓名
            $table->longText('journalComments_ins')->nullable();//企業指導員評語
            $table->longText('journalComments_teacher')->nullable();//老師評語
            $table->integer('grade_ins')->nullable();//企業評分
            $table->integer('grade_teacher')->nullable();//老師評分

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
