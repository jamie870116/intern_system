<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobOpenningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jopOpening', function (Blueprint $table) {
            $table->increments('joid');//AI
            $table->string('c_account',50);//廠商帳號
            $table->string('c_name',50);//廠商名稱
            $table->tinyInteger('jtypes');//職缺類型/0暑期實習 /1學期實習
            $table->string('jduties',300);//職務
            $table->longText('jdetails');//職務詳細 /薪水 必備條件 工作內容 特殊要求
            $table->integer('jsalary_up')->nullable();//薪水上限
            $table->integer('jsalary_low');//薪水下限 -1的話為面議
            $table->string('jcontact_name',20);//聯絡人姓名
            $table->string('jcontact_phone',50);//聯絡人電話
            $table->string('jcontact_email',150);//聯絡人信箱
            $table->string('jaddress',150);//工作地點
            $table->dateTime('jdeadline');//截止日期
            $table->integer('jNOP');//剩餘人數
            $table->longText('jdelete_reason')->nullable();//刪除理由
            $table->timestamps();//時間戳
            $table->softDeletes();//軟刪除
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jopOpening');
    }
}
