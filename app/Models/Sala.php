<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'cant_sillas_vip',
        'cant_sillas_normales',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function teatro () {
        return $this->belongsTo(Teatro::class, 'sala_id');
    }

    public function peliculas () {
        return $this->belongsToMany(Pelicula::class, 'peliculas_salas', 'pelicula_id');
    }

    public function boletas () {
        return $this->hasMany(Boleta::class, 'id');
    }

}
