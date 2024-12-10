<!-- Score Field -->
<div class="form-group col-sm-6">
    {!! Form::label('score', 'Score:') !!}
    {!! Form::text('score', null, ['class' => 'form-control', 'required', 'maxlength' => 50, 'maxlength' => 50]) !!}
</div>

<!-- Enrolment Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('enrolment_id', 'Enrolment Id:') !!}
    {!! Form::number('enrolment_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Letter Grade Field -->
<div class="form-group col-sm-6">
    {!! Form::label('letter_grade', 'Letter Grade:') !!}
    {!! Form::text('letter_grade', null, ['class' => 'form-control', 'maxlength' => 191, 'maxlength' => 191]) !!}
</div>