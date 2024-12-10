<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coursework extends Model
{
    public $table = 'courseworks';

    public $fillable = [
        'student_id',
        'marks',
        'enrolment_id',
        'cat_1',
        'cat_2',
        'assignment_1',
        'assignment_2',
        'assignment_3',
    ];

    protected $casts = [
        'marks' => 'decimal:0',
        'cat_1' => 'decimal:0',
        'cat_2' => 'decimal:0',
        'assignment_1' => 'decimal:0',
        'assignment_2' => 'decimal:0',
        'assignment_3' => 'decimal:0',
    ];

    public static array $rules = [
        'student_id' => 'required',
        'marks' => 'required|numeric|min:0|max:500',
        'enrolment_id' => 'required',
        'cat_1' => 'nullable|numeric|min:0|max:100',
        'cat_2' => 'nullable|numeric|min:0|max:100',
        'assignment_1' => 'nullable|numeric|min:0|max:100',
        'assignment_2' => 'nullable|numeric|min:0|max:100',
        'assignment_3' => 'nullable|numeric|min:0|max:100',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
    ];

    public function enrolment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Enrolment::class, 'enrolment_id');
    }

    public function student(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Student::class, 'student_id');
    }
}

