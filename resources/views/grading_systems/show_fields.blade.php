<!-- Grade Field -->
<div class="col-sm-12">
    {!! Form::label('grade', 'Grade:') !!}
    <p>{{ $gradingSystem->grade }}</p>
</div>

<!-- Min Score Field -->
<div class="col-sm-12">
    {!! Form::label('min_score', 'Min Score:') !!}
    <p>{{ $gradingSystem->min_score }}</p>
</div>

<!-- Max Score Field -->
<div class="col-sm-12">
    {!! Form::label('max_score', 'Max Score:') !!}
    <p>{{ $gradingSystem->max_score }}</p>
</div>

