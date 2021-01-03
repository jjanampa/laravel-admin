<div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">{{ __('Name:') }}</label>
    <div class="col-sm-7">
        <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" type="text"
               placeholder="{{ __('Name') }}" value="{{ old('name', $user->name) }}" required/>
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>

</div>
<div class="form-group row">
    <label for="email" class="col-sm-2 col-form-label">{{ __('Email:') }}</label>
    <div class="col-sm-7">
        <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" type="email"
               placeholder="{{ __('Email') }}" value="{{ old('email', $user->email) }}" required/>
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>

</div>
<div class="form-group row">
    <label for="password" class="col-sm-2 col-form-label">{{ __('Password:') }}</label>
    <div class="col-sm-7">
        <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password"
               type="password" placeholder="{{ __('Password') }}"
               @if ($formMode === 'create')
               required
            @endif />
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>

</div>
<div class="form-group row">
    <label for="role" class="col-sm-2 col-form-label">{{ __('Role:') }}</label>
    <div class="col-sm-7">
        <select class="form-control select2 {{ $errors->has('roles') ? ' is-invalid' : '' }} " name="roles[]" multiple required>
            @foreach ($roles as $key => $value)
                @if (old('roles'))
                    <option
                        value="{{ $key }}" {{ in_array($key, old('roles')) ? 'selected' : '' }}>{{ $value }}</option>
                @else
                    <option
                        value="{{ $key }}" {{ (in_array($key, $user_roles)) ? 'selected' : '' }}>{{ $value }}</option>
                @endif
            @endforeach
        </select>
        {!! $errors->first('roles', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row">
    <input type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}" class="btn btn-primary">
</div>
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endpush
