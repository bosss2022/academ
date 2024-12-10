<?php

namespace App\Services;

use App\Models\Enrolment;
use App\Models\Grade;
use App\Models\Grading_system;

class GradeService
{
    public function updateGradeScore($enrolmentId)
    {
        $enrolment = Enrolment::with(['exams', 'courseworks'])->findOrFail($enrolmentId);

        // Define weights in %
        $examWeight = 60;
        $courseworkWeight = 40;

        $examScore = $enrolment->exams->sum('marks');
        $courseworkScore = $enrolment->courseworks->sum('marks');

        // Normalize scores to ensure the total is out of 100
        $normalizedExamScore = ($examScore / 100) * $examWeight;
        $normalizedCourseworkScore = ($courseworkScore / 100) * $courseworkWeight;
        $totalScore = $normalizedExamScore + $normalizedCourseworkScore;

        // Update or create grade for this enrolment
        $grade = Grade::updateOrCreate(
            ['enrolment_id' => $enrolmentId],
            ['score' => round($totalScore, 2)] // Round to 2 decimal places
        );
        $grading = Grading_system::where('min_score', '<=', $totalScore)
        ->where('max_score', '>=', $totalScore)
        ->first();

if ($grading) {
$grade->update(['letter_grade' => $grading->grade]);
}

        return $grade;
    }
}
