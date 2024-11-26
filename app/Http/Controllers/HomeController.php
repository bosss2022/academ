<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Lecturer;
use App\Models\Receipt;
use App\Models\Student;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function employeesByDepartment()
{
    $data = DB::table('employees')
        ->join('departments', 'employees.department_id', '=', 'departments.id')
        ->select('departments.name as department', DB::raw('count(employees.id) as total'))
        ->groupBy('departments.name')
        ->get();

    $departments = $data->pluck('department'); // Get department names
    $totals = $data->pluck('total');          // Get total employees per department

    return view('home', compact('departments', 'totals'));
}

    public function index()
    {
        {
            // Get the total number of users
            $totalUsers = User::count();
            $totalStudents = Student::count();
            $totalEmployees = Employee::count();
            $totalDepartments = Department::count();
            $totalCourses = Course::count();
            $totalUnits = Unit::count();
            $totalLecturers = Lecturer::count();
            $totalPaid = Receipt::sum('amount_paid');
            $totalBalance = Receipt::sum('balance');
            $recentUsers = User::latest()->take(2)->get(); 
            
            $departments = Department::pluck('name')->toArray(); 
            $employeeCountsByDepartment = Department::withCount('employees')->pluck('employees_count')->toArray();

            $data = DB::table('employees')
            ->leftjoin('departments', 'employees.department_id', '=', 'departments.id')
            ->select('departments.name as department', DB::raw('count(employees.id) as total'))
            ->groupBy('departments.name')
            ->get();
    
        $departments = $data->pluck('department');
        $totals = $data->pluck('total');

            // Pass the total number of users to the view
            return view('home', compact('totalUsers', 'recentUsers', 'totalStudents', 'totalEmployees','totalDepartments', 'totalPaid', 'totalBalance', 'totalCourses', 'totalUnits', 'totalLecturers', 'departments', 'employeeCountsByDepartment', 'totals'));

              // Get the total paid amount
        //$totalAmount = Receipt::sum('amount_paid');

        // Get the total outstanding balance
       // $totalBalance = Receipt::sum('balance');

        // Get the number of paid and unpaid entries (optional)
        $totalPaidCount = Receipt::where('status', 'paid')->count();
        $totalUnpaidCount = Receipt::where('status', 'pending')->count();

        // Pass the data to the view
        return view('home', compact('totalPaid', 'totalBalance', 'totalPaidCount', 'totalUnpaidCount'));
        }
    }
}
