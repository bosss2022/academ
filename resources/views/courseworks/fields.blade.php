<!-- Student Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('student_id', 'Student:') !!}
    {!! Form::select('student_id',$students, null, ['class' => 'form-control', 'required', 'placeholder' => 'Select Student']) !!}
</div>

<!-- CAT 1 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cat_1', 'CAT 1:') !!}
    {!! Form::number('cat_1', null, ['class' => 'form-control', 'step' => '0.01', 'placeholder' => 'Enter marks for CAT 1']) !!}
</div>

<!-- CAT 2 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cat_2', 'CAT 2:') !!}
    {!! Form::number('cat_2', null, ['class' => 'form-control', 'step' => '0.01', 'placeholder' => 'Enter marks for CAT 2']) !!}
</div>

<!-- Assignment 1 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('assignment_1', 'Assignment 1:') !!}
    {!! Form::number('assignment_1', null, ['class' => 'form-control', 'step' => '0.01', 'placeholder' => 'Enter marks for Assignment 1']) !!}
</div>

<!-- Assignment 2 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('assignment_2', 'Assignment 2:') !!}
    {!! Form::number('assignment_2', null, ['class' => 'form-control', 'step' => '0.01', 'placeholder' => 'Enter marks for Assignment 2']) !!}
</div>

<!-- Assignment 3 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('assignment_3', 'Assignment 3:') !!}
    {!! Form::number('assignment_3', null, ['class' => 'form-control', 'step' => '0.01', 'placeholder' => 'Enter marks for Assignment 3']) !!}
</div>

<!-- Marks Field (Calculated Total) -->
<div class="form-group col-sm-6">
    {!! Form::label('marks', 'Total Marks:') !!}
    {!! Form::number('marks', null, ['class' => 'form-control', 'readonly', 'placeholder' => 'Total marks will be calculated']) !!}
</div>

<!-- Enrolment Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('enrolment_id', 'Enrolment:') !!}
    {!! Form::select('enrolment_id', $enrolments, null, ['class' => 'form-control', 'required', 'placeholder' => 'Select Enrolment']) !!}
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const cat1 = document.querySelector('[name="cat_1"]');
    const cat2 = document.querySelector('[name="cat_2"]');
    const assignment1 = document.querySelector('[name="assignment_1"]');
    const assignment2 = document.querySelector('[name="assignment_2"]');
    const assignment3 = document.querySelector('[name="assignment_3"]');
    const totalMarks = document.querySelector('[name="marks"]');

    function calculateTotal() {
        const total =
            (parseFloat(cat1.value) || 0) +
            (parseFloat(cat2.value) || 0) +
            (parseFloat(assignment1.value) || 0) +
            (parseFloat(assignment2.value) || 0) +
            (parseFloat(assignment3.value) || 0);
        totalMarks.value = total.toFixed(2); // Display with 2 decimal places
    }

    [cat1, cat2, assignment1, assignment2, assignment3].forEach(field => {
        field.addEventListener('input', calculateTotal);
    });
});
</script>