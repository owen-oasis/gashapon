<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGashaponPrizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gashapon_prizes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('prize')->comment('獎品名稱');
            $table->integer('cardinality')->default(0)->comment('基數');
            $table->integer('inventory')->default(0)->comment('庫存');
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
        Schema::dropIfExists('gashapon_prizes');
    }
}
