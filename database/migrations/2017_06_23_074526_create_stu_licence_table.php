<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStuLicenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stu_licence', function (Blueprint $table) {
            $table->integer('sid');//id
            $table->increments('lid');//AI
            $table->string('agency',200);//發證單位
            $table->string('lname',100);//證照名稱
            $table->date('ldate');//發證日期
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stu_licence');
    }
}
