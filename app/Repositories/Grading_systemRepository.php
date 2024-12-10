<?php

namespace App\Repositories;

use App\Models\Grading_system;
use App\Repositories\BaseRepository;

class Grading_systemRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'grade',
        'min_score',
        'max_score'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Grading_system::class;
    }
}
