<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStuExpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stu_jexp', function (Blueprint $table) {
            $table->integer('sid');//id
            $table->increments('jid');//AI
            $table->string('comName',50);//公司名稱
            $table->string('jobTitle',100);//職稱
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stu_jExp');
    }
}
