<?php

namespace App\Http\Controllers;

use App\DataTables\StudentDataTable;
use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Course;
use App\Models\Level;
use App\Models\User;
use App\Repositories\StudentRepository;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StudentController extends AppBaseController
{
    /** @var StudentRepository $studentRepository*/
    private $studentRepository;

    public function __construct(StudentRepository $studentRepo)
    {
        $this->studentRepository = $studentRepo;
    }

    /**
     * Display a listing of the Student.
     */
    public function index(StudentDataTable $studentDataTable)
    {
    return $studentDataTable->render('students.index');
    }


    /**
     * Show the form for creating a new Student.
     */
    public function create()
    {
        $levels = Level::pluck('name', 'id');
        $courses = Course::pluck('name', 'id');
        return view('students.create', compact('levels', 'courses'));
    }


    /**
     * Store a newly created Student in storage.
     */
    public function store(CreateStudentRequest $request)
    {
        // Debugging line to check incoming data
        Log::info('Student Form Submitted', ['data' => $request->all()]);
        
        // Start a database transaction
        DB::beginTransaction();
    
        try {
            // Get the validated data
            $validatedData = $request->validated(); // Use validated data instead of raw $request->all()
    
            // Ensure all required fields are included in the data being saved
            $studentData = [
                'admn_no' => $validatedData['admn_no'],
                'first_name' => $validatedData['first_name'],
                'surname' => $validatedData['surname'],
                'other_names' => $validatedData['other_names'],
                'email' => $validatedData['email'],
                'phone_number' => $validatedData['phone_number'],
                'address' => $validatedData['address'],
                'id_number' => $validatedData['id_number'],
                'date_of_admission' => $validatedData['date_of_admission'],
                'date_of_birth' => $validatedData['date_of_birth'],
                'level_id' => $validatedData['level_id'],
                'course_id' => $validatedData['course_id'],
                'gender' => $validatedData['gender'],
                'status' => $validatedData['status'],
                // Add any other necessary fields here
            ];
    
            // Create the student in the students table
            $student = $this->studentRepository->create($studentData);
    
            // Check if the email already exists in the 'users' table
            $existingUser = User::where('email', $request->email)->first();
    
            if ($existingUser) {
                // If the email already exists, update the existing user
                $existingUser->update([
                    'name' => $student->first_name . ' ' . $student->surname,
                    'password' => bcrypt('default_password'),
                ]);
    
                // Use the existing user's ID
                $user = $existingUser;
            } else {
                // Create a new user
                $user = User::create([
                    'name' => $student->first_name . ' ' . $student->surname,
                    'email' => $student->email,
                    'password' => bcrypt('default_password'),
                ]);
            }
    
            // Associate the user_id with the student
            $student->user_id = $user->id;
            $student->save();
    
            // Commit the transaction
            DB::commit();
    
            Flash::success('Student saved successfully.');
            return redirect(route('students.index'));
    
        } catch (\Exception $e) {
            // Rollback the transaction if any error occurs
            DB::rollBack();
    
            Log::error('Error occurred during student creation', ['error' => $e->getMessage()]);
            
            // Handle the error and show a flash message
            Flash::error('An error occurred while saving the student.');
            return redirect(route('students.create'))->withInput();
        }
    }
    
    
    /**
     * Display the specified Student.
     */
    public function show($id)
    {
        $student = $this->studentRepository->find($id);

        if (empty($student)) {
            Flash::error('Student not found');

            return redirect(route('students.index'));
        }

        return view('students.show')->with('student', $student);
    }

    /**
     * Show the form for editing the specified Student.
     */
    public function edit($id)
    {
        $student = $this->studentRepository->find($id);

        if (empty($student)) {
            Flash::error('Student not found');

            return redirect(route('students.index'));
        }
        $levels = Level::pluck('name', 'id');
        $courses = Course::pluck('name', 'id');

        return view('students.edit', compact('student', 'courses', 'levels'));
    }


    /**
     * Update the specified Student in storage.
     */
    public function update($id, UpdateStudentRequest $request)
    {
        $student = $this->studentRepository->find($id);

        if (empty($student)) {
            Flash::error('Student not found');

            return redirect(route('students.index'));
        }

        $student = $this->studentRepository->update($request->all(), $id);

        Flash::success('Student updated successfully.');

        return redirect(route('students.index'));
    }

    /**
     * Remove the specified Student from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $student = $this->studentRepository->find($id);

        if (empty($student)) {
            Flash::error('Student not found');

            return redirect(route('students.index'));
        }

        $this->studentRepository->delete($id);

        Flash::success('Student deleted successfully.');

        return redirect(route('students.index'));
    }
}
