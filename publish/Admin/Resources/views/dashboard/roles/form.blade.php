<div class="form-group row ">
    {!! Form::label('name', 'Name: ', ['class' => 'col-sm-2  control-label']) !!}
    <div class="col-sm-7">
        {!! Form::text('name', null, ['class' => 'form-control ' . ($errors->has('name') ? ' is-invalid' : ''), 'required' => true]) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>

</div>
<div class="form-group row">
    {!! Form::label('label', 'Label: ', ['class' => 'col-sm-2  control-label']) !!}
    <div class="col-sm-7">
        {!! Form::text('label', null, ['class' => 'form-control '. ($errors->has('label') ? ' is-invalid' : ''), 'required' => true]) !!}
        {!! $errors->first('label', '<p class="help-block">:message</p>') !!}
    </div>

</div>
<div class="form-group row">
    {!! Form::label('label', 'Permissions: ', ['class' => 'col-sm-2  control-label']) !!}
    <div class="col-sm-7">
        {!! Form::select('permissions[]', $permissions, isset($role) ? $role->permissions->pluck('name') : [], ['class' => 'form-control select2 ' . ($errors->has('permissions') ? ' is-invalid' : ''), 'multiple' => true]) !!}
        {!! $errors->first('permissions', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
           $('.select2').select2();
        });
    </script>
@endpush
