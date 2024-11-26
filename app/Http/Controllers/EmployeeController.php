<?php

namespace App\Http\Controllers;

use App\DataTables\EmployeeDataTable;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Department;
use App\Models\School;
use App\Models\User;
use App\Repositories\EmployeeRepository;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EmployeeController extends AppBaseController
{
    /** @var EmployeeRepository $employeeRepository*/
    private $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepo)
    {
        $this->employeeRepository = $employeeRepo;
    }

    /**
     * Display a listing of the Employee.
     */
    public function index(EmployeeDataTable $employeeDataTable)
    {
    return $employeeDataTable->render('employees.index');
    }


    /**
     * Show the form for creating a new Employee.
     */
    public function create()
    {
        $schools = School::pluck('name', 'id');
        $departments = Department::pluck('name', 'id');
        return view('employees.create', compact('schools', 'departments'));
    }

    /**
     * Store a newly created Employee in storage.
     */

     public function store(CreateEmployeeRequest $request)
     {
         // Debugging line to check incoming data
         Log::info('Form Submitted', ['data' => $request->all()]);
         
         // Start a database transaction
         DB::beginTransaction();
     
         try {
             // Get the validated data
             $validatedData = $request->validated(); // Use validated data instead of raw $request->all()
     
             // Ensure all required fields are included in the data being saved
             $employeeData = [
                 'first_name' => $validatedData['first_name'],
                 'last_name' => $validatedData['last_name'],
                 'email' => $validatedData['email'],
                 'phone_number' => $validatedData['phone_number'],
                 'id_number' => $validatedData['id_number'],
                 'title' => $validatedData['title'],
                 'address' => $validatedData['address'],
                 'school_id' => $validatedData['school_id'],
                 'department_id' => $validatedData['department_id'],
                 // Add any other necessary fields here
             ];
     
             // Create the employee in the employees table
             $employee = $this->employeeRepository->create($employeeData);
     
             // Check if the email already exists in the 'users' table
             $existingUser = User::where('email', $request->email)->first();
     
             if ($existingUser) {
                 // If the email already exists, update the existing user
                 $existingUser->update([
                     'name' => $employee->first_name . ' ' . $employee->last_name,
                     'password' => bcrypt('default_password'),
                 ]);
     
                 // Use the existing user's ID
                 $user = $existingUser;
             } else {
                 // Create a new user
                 $user = User::create([
                     'name' => $employee->first_name . ' ' . $employee->last_name,
                     'email' => $employee->email,
                     'password' => bcrypt('default_password'),
                 ]);
             }
     
             // Associate the user_id with the employee
             $employee->user_id = $user->id;
             $employee->save();
     
             // Commit the transaction
             DB::commit();
     
             Flash::success('Employee saved successfully.');
             return redirect(route('employees.index'));
     
         } catch (\Exception $e) {
             // Rollback the transaction if any error occurs
             DB::rollBack();
     
             Log::error('Error occurred during employee creation', ['error' => $e->getMessage()]);
             
             // Handle the error and show a flash message
             Flash::error('An error occurred while saving the employee.');
             return redirect(route('employees.create'))->withInput();
         }
     }
     
     
    /**
     * Display the specified Employee.
     */
    public function show($id)
    {
        $employee = $this->employeeRepository->find($id);

        if (empty($employee)) {
            Flash::error('Employee not found');

            return redirect(route('employees.index'));
        }

        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified Employee.
     */
    public function edit($id)
    {
        $employee = $this->employeeRepository->find($id);
    
        if (empty($employee)) {
            Flash::error('Employee not found');
            return redirect(route('employees.index'));
        }
    
        // Fetch schools as an associative array with id as the key and name as the value
        $schools = School::pluck('name', 'id');
        $departments = Department::pluck('name', 'id');

    
        // Pass both employee and schools data to the view
        return view('employees.edit', compact('employee', 'schools', 'departments'));
    }

    /**
     * Update the specified Employee in storage.
     */
    public function update($id, UpdateEmployeeRequest $request)
    {
        $employee = $this->employeeRepository->find($id);

        if (empty($employee)) {
            Flash::error('Employee not found');

            return redirect(route('employees.index'));
        }

        $employee = $this->employeeRepository->update($request->all(), $id);

        Flash::success('Employee updated successfully.');

        return redirect(route('employees.index'));
    }

    /**
     * Remove the specified Employee from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $employee = $this->employeeRepository->find($id);

        if (empty($employee)) {
            Flash::error('Employee not found');

            return redirect(route('employees.index'));
        }

        $this->employeeRepository->delete($id);

        Flash::success('Employee deleted successfully.');

        return redirect(route('employees.index'));
    }
}
