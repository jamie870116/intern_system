<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');//AI
            $table->string('u_name',20);//名字
            $table->string('email',50)->unique();//信箱
            $table->string('password',100);//密碼
            $table->integer('u_status');//權限
            $table->string('u_tel',20);//電話
            $table->string('account',50);//帳號
            $table->tinyInteger('started')->default(0);//是否開通 //0，未開通；1，開通；2，廠商待審核；3，帳號停用
            $table->string('check_code',50)->nullable();//驗證碼
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
