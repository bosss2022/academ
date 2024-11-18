<?php
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');

});


Route::middleware(['auth:employee'])->group(function () {
  Route::get('/home', function () {
      return view('employee.index');
  })->name('employee.index');
});


//Route::middleware(['role:admin'])->group(function () {
  //Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//});
 
 //Route::middleware(['role:user'])->group(function () {
  //Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
 //});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();



Route::resource('students', App\Http\Controllers\StudentController::class);
Route::resource('courses', App\Http\Controllers\CourseController::class);
Route::resource('levels', App\Http\Controllers\LevelController::class);
Route::resource('departments', App\Http\Controllers\DepartmentController::class);
Route::resource('schools', App\Http\Controllers\SchoolController::class);
Route::resource('employees', App\Http\Controllers\EmployeeController::class);
Route::resource('fees', App\Http\Controllers\FeeController::class);
Route::resource('units', App\Http\Controllers\UnitController::class);
Route::resource('invoices', App\Http\Controllers\InvoiceController::class);
Route::resource('receipts', App\Http\Controllers\ReceiptController::class);
Route::resource('lecturers', App\Http\Controllers\LecturerController::class);
Route::resource('enrolments', App\Http\Controllers\EnrolmentController::class);
Route::resource('grades', App\Http\Controllers\GradeController::class);