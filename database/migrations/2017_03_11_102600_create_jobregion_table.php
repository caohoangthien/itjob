<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobregionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobregion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_job')->unsigned();
            $table->foreign('id_job')->references('id')->on('jobs');
            $table->integer('id_region')->unsigned();
            $table->foreign('id_region')->references('id')->on('regions');
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
        Schema::drop('jobregion');
    }
}
