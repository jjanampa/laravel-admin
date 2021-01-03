<div class="form-group row">
    {!! Form::label('name', 'Name: ', ['class' => 'col-sm-2  control-label']) !!}
    <div class="col-sm-7">
        {!! Form::text('name', null, ['class' => 'form-control ' . ($errors->has('name') ? ' is-invalid' : ''), 'required' => true]) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('label', 'Label: ', ['class' => 'col-sm-2  control-label']) !!}
    <div class="col-sm-7">
        {!! Form::text('label', null, ['class' => 'form-control ' . ($errors->has('label') ? ' is-invalid' : '')]) !!}
        {!! $errors->first('label', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
