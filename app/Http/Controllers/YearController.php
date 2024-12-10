<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\UnitDataTable;
use Yajra\DataTables\DataTables;

use App\Models\Unit;
use App\Models\Course;


class YearController extends Controller
{
    public function index()
    {
        // Retrieve all units together with related courses
        $units = Unit::with('course')->get();

        // Debugging: Check if units are retrieved
        if ($units->isEmpty()) {
            return "No units found in the database!";
        }

        // Initialize an empty array for grouped units by year
        $groupedUnits = [
            1 => [], // Year 1
            2 => [], // Year 2
            3 => [], // Year 3
            4 => []  // Year 4
        ];

        // Loop through each unit and group them by year
        foreach ($units as $unit) {
            // Extract the year from the last digit of the unit code
            $year = (int) substr($unit->unit_code, 4, 1); // Extract the digit after '2' (starting from index 3)


            // Group units by the extracted year
            if (array_key_exists($year, $groupedUnits)) {
                $groupedUnits[$year][] = $unit;
            }
        }

        // Debugging: Check if grouping is correct
        // dd($groupedUnits); // Uncomment this to inspect the grouped data

        // Return the view with the grouped units
        return view('year.index', compact('groupedUnits'));
    }
}
