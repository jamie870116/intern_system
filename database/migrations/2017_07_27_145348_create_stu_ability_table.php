<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStuAbilityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stu_ability', function (Blueprint $table) {

            $table->increments('abiid');//AI
            $table->integer('sid');//
            $table->tinyInteger('abiType');//能力類型
            $table->string('abiName',100)->nullable();//能力名稱

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stu_ability');
    }
}
