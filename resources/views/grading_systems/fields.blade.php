<!-- Grade Field -->
<div class="form-group col-sm-6">
    {!! Form::label('grade', 'Grade:') !!}
    {!! Form::text('grade', null, ['class' => 'form-control', 'required', 'maxlength' => 191, 'maxlength' => 191]) !!}
</div>

<!-- Min Score Field -->
<div class="form-group col-sm-6">
    {!! Form::label('min_score', 'Min Score:') !!}
    {!! Form::number('min_score', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Max Score Field -->
<div class="form-group col-sm-6">
    {!! Form::label('max_score', 'Max Score:') !!}
    {!! Form::number('max_score', null, ['class' => 'form-control', 'required']) !!}
</div>