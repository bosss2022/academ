<!-- Score Field -->
<div class="col-sm-12">
    {!! Form::label('score', 'Score:') !!}
    <p>{{ $grade->score }}</p>
</div>

<!-- Enrolment Id Field -->
<div class="col-sm-12">
    {!! Form::label('enrolment_id', 'Enrolment Id:') !!}
    <p>{{ $grade->enrolment_id }}</p>
</div>

<!-- Letter Grade Field -->
<div class="col-sm-12">
    {!! Form::label('letter_grade', 'Letter Grade:') !!}
    <p>{{ $grade->letter_grade }}</p>
</div>

