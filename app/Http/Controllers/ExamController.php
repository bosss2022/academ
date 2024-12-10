<?php

namespace App\Http\Controllers;

use App\DataTables\ExamDataTable;
use App\Events\ScoresUpdated;
use App\Http\Requests\CreateExamRequest;
use App\Http\Requests\UpdateExamRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Enrolment;
use App\Models\Student;
use App\Repositories\ExamRepository;
use Illuminate\Http\Request;
use Flash;

class ExamController extends AppBaseController
{
    /** @var ExamRepository $examRepository*/
    private $examRepository;

    public function __construct(ExamRepository $examRepo)
    {
        $this->examRepository = $examRepo;
    }

    /**
     * Display a listing of the Exam.
     */
    public function index(ExamDataTable $examDataTable)
    {
    return $examDataTable->render('exams.index');
    }


    /**
     * Show the form for creating a new Exam.
     */
    public function create()
    {
        $students = Student::select('id', 'admn_no', 'surname', 'first_name')
            ->get()
            ->mapWithKeys(function ($student) {
                return [$student->id => $student->admn_no . ' ' . $student->surname . ' ' . $student->first_name];
            });
    
        // Pluck `unit.id` as the key and `unit.unit_name` as the value for the dropdown
        $enrolments = Enrolment::with('unit')->get()->pluck('unit.unit_name', 'id');
    
        return view('exams.create', compact('students', 'enrolments'));
    }
    

    /**
     * Store a newly created Exam in storage.
     */
    public function store(CreateExamRequest $request)
{
    $input = $request->all();

    // Create the exam record
    $exam = $this->examRepository->create($input);

    $enrolment = $exam->enrolment;

    if ($enrolment->exams->isNotEmpty() && $enrolment->courseworks->isNotEmpty()) {
        event(new ScoresUpdated($enrolment));
    }
    Flash::success('Exam saved successfully.');

    return redirect(route('exams.index'));
}

    /**
     * Display the specified Exam.
     */
    public function show($id)
    {
        $exam = $this->examRepository->find($id);

        if (empty($exam)) {
            Flash::error('Exam not found');

            return redirect(route('exams.index'));
        }

        return view('exams.show')->with('exam', $exam);
    }

    /**
     * Show the form for editing the specified Exam.
     */
    public function edit($id)
    {
        $exam = $this->examRepository->find($id);

        if (empty($exam)) {
            Flash::error('Exam not found');

            return redirect(route('exams.index'));
        }
        $students = Student::select('id', 'admn_no', 'surname', 'first_name')
        ->get()
        ->mapWithKeys(function ($student) {
            return [$student->id => $student->admn_no . ' ' . $student->surname . ' ' . $student->first_name];
        });

    // Pluck `unit.id` as the key and `unit.unit_name` as the value for the dropdown
    $enrolments = Enrolment::with('unit')->get()->pluck('unit.unit_name', 'id');

        return view('exams.edit',compact('exam', 'students','enrolments'));
    }

    /**
     * Update the specified Exam in storage.
     */
    public function update($id, UpdateExamRequest $request)
    {
        $exam = $this->examRepository->find($id);

        if (empty($exam)) {
            Flash::error('Exam not found');

            return redirect(route('exams.index'));
        }

        $exam = $this->examRepository->update($request->all(), $id);

        Flash::success('Exam updated successfully.');

        return redirect(route('exams.index'));
    }

    /**
     * Remove the specified Exam from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $exam = $this->examRepository->find($id);

        if (empty($exam)) {
            Flash::error('Exam not found');

            return redirect(route('exams.index'));
        }

        $this->examRepository->delete($id);

        Flash::success('Exam deleted successfully.');

        return redirect(route('exams.index'));
    }
}
