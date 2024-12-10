<!-- Student Id Field -->
<div class="col-sm-12">
    {!! Form::label('student_id', 'Student:') !!}
    <p>{{ $coursework->student->admn_no }} {{ $coursework->student->surname }} {{ $coursework->student->first_name }}</p>
</div>

<!-- Marks Field -->
<div class="col-sm-12">
    {!! Form::label('marks', 'Marks:') !!}
    <p>{{ $coursework->marks }}</p>
</div>

<!-- CAT 1 Field -->
<div class="col-sm-12">
    {!! Form::label('cat_1', 'CAT 1:') !!}
    <p>{{ $coursework->cat_1 ?? 'N/A' }}</p>
</div>

<!-- CAT 2 Field -->
<div class="col-sm-12">
    {!! Form::label('cat_2', 'CAT 2:') !!}
    <p>{{ $coursework->cat_2 ?? 'N/A' }}</p>
</div>

<!-- Assignment 1 Field -->
<div class="col-sm-12">
    {!! Form::label('assignment_1', 'Assignment 1:') !!}
    <p>{{ $coursework->assignment_1 ?? 'N/A' }}</p>
</div>

<!-- Assignment 2 Field -->
<div class="col-sm-12">
    {!! Form::label('assignment_2', 'Assignment 2:') !!}
    <p>{{ $coursework->assignment_2 ?? 'N/A' }}</p>
</div>

<!-- Assignment 3 Field -->
<div class="col-sm-12">
    {!! Form::label('assignment_3', 'Assignment 3:') !!}
    <p>{{ $coursework->assignment_3 ?? 'N/A' }}</p>
</div>

<!-- Enrolment Id Field -->
<div class="col-sm-12">
    {!! Form::label('enrolment_id', 'Enrolment:') !!}
    <p>{{ $coursework->enrolment ? $coursework->enrolment->unit->unit_name : 'N/A' }}</p>
</div>


