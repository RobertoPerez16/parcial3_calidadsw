<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teatro extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'sala_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];


    public function festivales () {
        return $this->belongsToMany(Festival::class, 'festival_teatros');
    }

    public function sala () {
        return $this->hasMany(Sala::class, 'id');
    }
}
