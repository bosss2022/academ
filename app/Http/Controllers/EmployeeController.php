<?php

namespace App\Http\Controllers;

use App\DataTables\EmployeeDataTable;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Department;
use App\Models\School;
use App\Repositories\EmployeeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Flash;

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
        return view('employees.create', compact('schools'));
    }

    /**
     * Store a newly created Employee in storage.
     */
    public function store(CreateEmployeeRequest $request)
    {
        $input = $request->all();

        $employee = $this->employeeRepository->create($input);

        Flash::success('Employee saved successfully.');

        return redirect(route('employees.index'));
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


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'id_number' => ['required'],
        ]);

        if (Auth::guard('employee')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('employees.index');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('employee')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/Auth/login');
 
        }
        
}

