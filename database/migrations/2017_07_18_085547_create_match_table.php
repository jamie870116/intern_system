<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match', function (Blueprint $table) {
            $table->increments('mid'); //AI
            $table->integer('sid'); //學生ID
            $table->integer('cid'); //廠商ID
            $table->integer('tid')->nullable(); //老師ID(系辦給；如果為空值，代表系辦未審核，成功才可輸入tid)
            $table->longText('mfailedreason')->nullable();//如果不為空值代表審核失敗，可供日後追蹤
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('match');
    }
}
