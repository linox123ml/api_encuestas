<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyQuestion extends Model
{
    use HasFactory;

    protected $primaryKey = "DocumentId";
    public $timestamps = false;

    protected $fillable = [
        'Id',
        'SectionId',
        'OrdinalOnView',
        'Title',
        'Description',
        'TypeQuestion',
        'Status',
        'IsRequired',
        'IsInline',
        'IsEnabled'
    ];

    protected $casts = [
        'IsRequired' => 'boolean',
        'IsInline' => 'boolean',
        'IsEnabled' => 'boolean'
    ];
}
