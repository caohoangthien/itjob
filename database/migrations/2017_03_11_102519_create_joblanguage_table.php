<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJoblanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('joblanguage', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_job')->unsigned();
            $table->foreign('id_job')->references('id')->on('jobs');
            $table->integer('id_language')->unsigned();
            $table->foreign('id_language')->references('id')->on('languages');
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
        Schema::drop('joblanguage');
    }
}
