<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStuEduTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stu_edu', function (Blueprint $table) {
            $table->integer('sid');//id
            $table->increments('edu_id');//AI
            $table->string('school',50);//學校名稱
            $table->string('department',20);//科系
            $table->string('degree',20)->nullable();//學位
            $table->date('enterDate');//入校日期
            $table->date('exitDate')->nullable();//離校日期，就讀中不必填
            $table->integer('graduate');//就讀狀態
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stu_edu');
    }
}
