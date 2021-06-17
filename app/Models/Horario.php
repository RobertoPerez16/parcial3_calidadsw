<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $fillable = [
        'horario',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function peliculas () {
        return $this->belongsToMany(Pelicula::class, 'horario_pelicula');
    }

}
