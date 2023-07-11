<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyParticipant extends Model
{
    use HasFactory;

    protected $primaryKey = "DocumentId";
    protected $table = 'Survey_Participants';    
    public $timestamps = false;

    protected $fillable = [
        'TypeDocument',
        'AccessWord',
        'Firstname',
        'Lastname',
        'Condition',
        'RequiredPasswordReset',
        'IsEnabled',
    ];

    protected $casts = [
        'RequiredPasswordReset' => 'boolean',
        'IsEnabled' => 'boolean',
    ];

}
