<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'duracion',
        'creditos',
        'director',
        'pais',
        'banda_anuncio'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function salas () {
        return $this->belongsToMany(Sala::class, 'peliculas_salas');
    }

    public function horarios () {
        return $this->belongsToMany(Horario::class, 'horario_pelicula');
    }
}
