<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorarioPeliculaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horario_pelicula', function (Blueprint $table) {
            $table->id();
            $table->foreignId('horario_id')->constrained('horarios')->onDelete('cascade');
            $table->foreignId('pelicula_id')->constrained('peliculas')->onDelete('cascade');
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
        Schema::dropIfExists('horario_pelicula');
    }
}
