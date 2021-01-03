<div class="form-group row">
    {!! Form::label('title', 'Title', ['class' => 'col-sm-2  control-label']) !!}
    <div class="col-sm-7">
        {!! Form::text('title', null, ['class' => 'form-control ' . ($errors->has('title') ? ' is-invalid' : ''), 'required' => true]) !!}
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('content', 'Content', ['class' => 'col-sm-2  control-label']) !!}
    <div class="col-sm-7">
        {!! Form::textarea('content', null, ['class' => 'form-control textarea-editor' . ($errors->has('content') ? ' is-invalid' : '')]) !!}
        {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.6.2/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: '.textarea-editor'
        });
    </script>
@endpush
