<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notas extends Model
{
    use HasFactory;

    protected $fillable = [
        'psicologo',
        'paciente',
        'nota',
    ];

    public function psicologo()
    {
        return $this->belongsTo(User::class, 'psicologo');
    }

    public function paciente()
    {
        return $this->belongsTo(User::class, 'paciente');
    }
}
