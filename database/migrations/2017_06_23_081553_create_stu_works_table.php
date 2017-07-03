<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStuWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stu_works', function (Blueprint $table) {
            $table->integer('sid');//id
            $table->increments('wid');//AI
            $table->string('wName',50);//作品名稱
            $table->string('wLink',20)->nullable();//作品連結
            $table->date('wCreatedDate')->nullable();//作品年份
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stu_works');
    }
}
