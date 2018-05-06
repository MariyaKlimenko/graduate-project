<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')
                ->unsigned()
                ->nullable()
                ->index();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->string('university')
                  ->nullable();

            $table->string('speciality')
                  ->nullable();

            $table->string('degree')
                  ->nullable();

            $table->integer('country_id')
                  ->unsigned()
                  ->index()
                  ->nullable();

            $table->foreign('country_id')
                ->references('id')
                ->on('countries')
                ->onDelete('cascade');

            $table->string('started_at')
                  ->nullable();


            $table->string('finished_at')
                  ->nullable();

            $table->boolean('is_not_finished')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('education');
    }
}
