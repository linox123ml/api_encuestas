<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyPositionOnSurvey extends Model
{
    use HasFactory;

    // protected $primaryKey = "SurveyId"; 
    public $timestamps = false;
    protected $table = 'Survey_PositionOnSurvey';


    protected $fillable = [
        'DocumentId',
        'SurveyId',
        'TopicId',
        'SectionId',
    ];
}
