<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyPlace extends Model
{
    use HasFactory;

    protected $primaryKey = "Id";
    protected $table = 'Survey_Places';    
    public $timestamps = false;

    protected $fillable = [
        'Id',
        'Region',
        'Department',
        'Province',
        'District',
    ];
}
