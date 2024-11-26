<?php

namespace App\Events;

use App\Models\Enrolment;
use App\Services\GradeService;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ScoresUpdated
{
    use Dispatchable, SerializesModels;

    public $enrolment;

    /**
     * Create a new event instance.
     *
     * @param Enrolment $enrolment
     */
    public function __construct(Enrolment $enrolment)
    {
        $this->enrolment = $enrolment;
    }
    public function handle(ScoresUpdated $event)
{
    // Debugging: Log the enrolment ID
    Log::info('ScoresUpdated Event Triggered', ['enrolment_id' => $event->enrolment->id]);

    // Update grade score using the service
    $gradeService = app(GradeService::class);
    $gradeService->updateGradeScore($event->enrolment);
}
}
