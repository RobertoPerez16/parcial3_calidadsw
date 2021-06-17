<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFestivalTeatrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('festival_teatros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('festival_id');
            $table->unsignedBigInteger('teatro_id');

            $table->foreign('festival_id')->references('id')
                ->on('festivals')
                ->onDelete('cascade');

            $table->foreign('teatro_id')->references('id')
                ->on('teatros')
                ->onDelete('cascade');
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
        Schema::dropIfExists('festival_teatros');
    }
}
