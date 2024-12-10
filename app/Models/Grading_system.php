<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grading_system extends Model
{
    public $table = 'grading_system';

    public $fillable = [
        'grade',
        'min_score',
        'max_score'
    ];

    protected $casts = [
        'grade' => 'string'
    ];

    public static array $rules = [
        'grade' => 'required|string|max:191',
        'min_score' => 'required',
        'max_score' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
