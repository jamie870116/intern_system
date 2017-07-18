<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComBasicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('com_basic', function (Blueprint $table) {
            $table->string('c_account',50)->primary();//廠商帳號
            $table->tinyInteger('ctypes');//行業類別
            $table->string('caddress',300);//地址
            $table->string('cfax',50)->nullable();//傳真
            $table->longText('cintroduction'); //簡介
            $table->integer('cempolyee_num')->nullable(); //員工人數
            $table->longText('cdeleteReason')->nullable();//刪除理由
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
        Schema::dropIfExists('com_basic');
    }
}
