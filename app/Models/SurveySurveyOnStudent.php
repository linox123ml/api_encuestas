<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveySurveyOnStudent extends Model
{
    use HasFactory;

    // protected $primaryKey = "SurveyId";
    protected $table = 'Survey_SurveyOnStudents';    
    public $timestamps = false;

    protected $fillable = [
        'SurveyId',
        'DocumentId',
        'UniversityId',
        'AcademicalProgramId', 
    ]; 
}
