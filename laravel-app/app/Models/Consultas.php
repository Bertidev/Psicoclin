<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultas extends Model
{
    use HasFactory;

    protected $fillable = [
        'psicologo_id',
        'paciente_id',
        'data',
    ];

    public function psicologo()
    {
        return $this->belongsTo(User::class, 'psicologo_id');
    }

    public function paciente()
    {
        return $this->belongsTo(User::class, 'paciente_id');
    }
}

