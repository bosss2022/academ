<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Coursework;
use App\Models\Grade;
use App\Http\Controllers\AppBaseController;
  
    class MarksController extends Controller
    {
        public function calculateMarks()
        {
            $results = Exam::with(['coursework'])
            ->get()
            ->map(function ($exam) {
                $examWeight = $exam->exam_weight ?? 0;
                $courseworkWeight = $exam->coursework->course_weight ?? 0;

                $examMarks = ($exam->exam_marks* $examWeight) / 100;
                $courseworkMarks = ($exam->coursework->marks?? 0) * $courseworkWeight / 100;

                return [
                    'student_id' => $exam->student_id,
                    'unit_id' => $exam->unit_id,
                    'exam_score' => $examMarks + $courseworkMarks,
                ];
            });

        // Pass data to the view
        return view('marks.index', ['results' => $results]);
        }
    }
    


