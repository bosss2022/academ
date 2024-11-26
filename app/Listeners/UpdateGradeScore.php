<?php

namespace App\Listeners;

use App\Events\ScoresUpdated;
use App\Models\Grade;
use App\Services\GradeService;

class UpdateGradeScore
{
    protected $gradeService;

    public function __construct(GradeService $gradeService)
    {
        $this->gradeService = $gradeService;
    }

    public function updateGradeScore($enrolment)
{
    // Ensure $enrolment has loaded exams and courseworks
    $examScore = $enrolment->exams->sum('score'); // Replace 'score' with your column name in the exams table
    $courseworkScore = $enrolment->courseworks->sum('score'); // Replace 'score' with your column name in the courseworks table
    $totalScore = $examScore + $courseworkScore;

    // Update or create the grade
    $grade = Grade::updateOrCreate(
        ['enrolment_id' => $enrolment->id],
        ['score' => $totalScore]
    );

    return $grade;
}


    /**
     * Handle the event.
     *
     * @param ScoresUpdated $event
     * @return void
     */
    public function handle(ScoresUpdated $event)
    {
        // Call the GradeService to update the grade
        $this->gradeService->updateGradeScore($event->enrolment->id);
    }
}
