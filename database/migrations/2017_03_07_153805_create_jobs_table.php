<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_company')->unsigned();
            $table->foreign('id_company')->references('id')->on('companies');
            $table->string('title');
            $table->string('describe');
            $table->integer('min_salary');
            $table->integer('max_salary');
            $table->integer('id_language')->unsigned();
            $table->foreign('id_language')->references('id')->on('languages');
            $table->integer('id_level')->unsigned();
            $table->foreign('id_level')->references('id')->on('levels');
            $table->integer('quantity');
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
        Schema::drop('jobs');
    }
}
