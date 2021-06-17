<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boleta extends Model
{
    use HasFactory;
    protected $fillable = [
        'cantidad',
        'tipo_boleta',
        'cliente_id',
        'sala_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function sala () {
        return $this->belongsTo(Sala::class);
    }

    public function cliente () {
        return $this->belongsTo(Cliente::class, 'id');
    }
}
