<div class="form-group row">
    {!! Form::label('key', 'Key', ['class' => 'col-sm-2  control-label']) !!}
    <div class="col-sm-7">
        {!! Form::text('key', null, ['class' => 'form-control ' . ($errors->has('key') ? ' is-invalid' : ''), 'required' => true]) !!}
        {!! $errors->first('key', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('value', 'Value', ['class' => 'col-sm-2  control-label']) !!}
    <div class="col-sm-7">
        {!! Form::text('value', null, ['class' => 'form-control ' . ($errors->has('value') ? ' is-invalid' : '') , 'required' => true]) !!}
        {!! $errors->first('value', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row ">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
