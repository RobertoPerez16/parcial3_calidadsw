<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Festival extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'duracion',
        'patrocinador',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function teatros () {
        return $this->belongsToMany(Teatro::class, 'festival_teatros');
    }

}

