<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notas extends Model
{
    use HasFactory;

    protected $fillable = [
        'psicologo',
        'consulta',
        'nota',
    ];

    public function psicologo()
    {
        return $this->belongsTo(User::class, 'psicologo');
    }

    public function consulta()
    {
        return $this->belongsTo(Consultas::class, 'consulta');
    }
}
