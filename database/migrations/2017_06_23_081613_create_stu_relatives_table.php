<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStuRelativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stu_relatives', function (Blueprint $table) {
            $table->integer('sid');//id
            $table->increments('rid');//AI
            $table->string('rType',50);//親屬關係
            $table->string('rName',20);//親屬姓名
            $table->integer('rAge')->nullable();//親屬年齡
            $table->string('rEdu',50)->nullable();//親屬教育程度
            $table->string('rJob',50)->nullable();//親屬職業
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stu_relatives');
    }
}
