<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

class SurveyAnswer extends Model
{
    use HasFactory;

    // protected $primaryKey = "DocumentId"; 
    public $timestamps = false;
    protected $table = 'Survey_Answers';

    protected $fillable = [
        'ResponseOptions',
        'ResponseText',
        'DocumentId',
        'QuestionId',

    ];

}
