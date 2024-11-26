<?php

namespace App\Observers;

use App\Events\ScoresUpdated;
use App\Models\Exam;

class ExamObserver
{
    public function saved(Exam $exam)
    {
        $enrolment = $exam->enrolment; // Assuming there's a relationship
        if ($enrolment->exams->isNotEmpty() && $enrolment->courseworks->isNotEmpty()) {
            event(new ScoresUpdated($enrolment));
        }
    }
}

