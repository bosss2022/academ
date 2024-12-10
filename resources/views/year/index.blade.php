@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Welcome Section -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-10">
            <div>
               
            </div>
        </div>
    </div>
    @foreach ($groupedUnits as $year => $yearUnits)
    <h2>Year {{ $year }}</h2>

    <!-- Start of the table -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Unit Code</th>
                <th>Unit Name</th>
                <th>Course</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($yearUnits as $unit)
                <tr>
                    <td>{{ $unit->unit_code }}</td>
                    <td>{{ $unit->unit_name }}</td>
                    <td>{{ $unit->course->name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No units for Year {{ $year }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endforeach



    @endsection