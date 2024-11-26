<?php

namespace App\Observers;

use App\Events\ScoresUpdated;
use App\Models\Coursework;

class CourseworkObserver
{
    public function saved(Coursework $coursework)
    {
        $enrolment = $coursework->enrolment; // Assuming there's a relationship
        if ($enrolment->exams->isNotEmpty() && $enrolment->courseworks->isNotEmpty()) {
            event(new ScoresUpdated($enrolment));
        }
    }
}

