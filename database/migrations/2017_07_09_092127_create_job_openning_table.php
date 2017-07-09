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
            $table->tinyInteger('jtypes');//職缺類型/0工讀/1實習/2兼職/3正職
            $table->string('jduties',300);//職務
            $table->longText('jdetails');//職務詳細 /薪水 必備條件 工作內容 特殊要求
            $table->string('jsalary',300);//薪水
            $table->string('jcontact_name',20);//聯絡人姓名
            $table->string('jcontact_phone',50);//聯絡人電話
            $table->string('jcontact_email',150);//聯絡人信箱
            $table->tinyInteger('jstatus')->default(0);//職缺狀態/0.尚未確認 1.通過 2.未通過 3.已刪
            $table->longText('jdelete_reason')->nullable();//刪除理由
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
