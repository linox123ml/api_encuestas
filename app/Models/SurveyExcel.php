<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyExcel extends Model
{
    use HasFactory;
 
    protected $table = 'survey_excels';    
    public $timestamps = false;

    protected $fillable = [
        'codigo_matricula',
        'dni',
        'paterno',
        'materno',
        'nombre',
        'facultad',
        'escuela_profesional',
        'ciclo',
        'sexo',
        'edad',
        'departamento',
        'provincia',
        'distrito', 
    ];
 
}
