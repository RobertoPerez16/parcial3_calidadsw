<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_names',
        'edad',
        'cedula',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function boletas () {
        return $this->hasMany(Boleta::class, 'id');
    }
}
