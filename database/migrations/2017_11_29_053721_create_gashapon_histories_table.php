<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGashaponHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gashapon_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone')->comment('使用者電話')->nullable();
            $table->string('prize')->comment('抽獎紀錄')->nullable();
            $table->string('ip')->comment('抽獎IP位置');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gashapon_histories');
    }
}
