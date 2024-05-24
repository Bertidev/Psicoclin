<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notas extends Model
{
    use HasFactory;

    protected $fillable = [
        'psicologo',
        'paciente',
        'nota',
    ];

    public function psicologo()
    {
        return $this = belongsTo(Users::class, 'psicologo');
    }

    public function paciente()
    {
        return $this = belongsTo(Users::class,'paciente');
    }
}
