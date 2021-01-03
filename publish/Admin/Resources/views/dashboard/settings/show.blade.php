@extends('admin::layouts.app', ['titlePage' => __('Settings')])

@section('content')
    <div class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Show Setting') }} #{{ $setting->id }}</h4>
                    </div>
                    <div class="card-body">

                        <a href="{{ route('admin.settings.index') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{ __('Back') }}</button></a>
                        <a href="{{ route('admin.settings.edit', $setting) }}" title="Edit Setting"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> {{ __('Edit') }}</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'route' => ['admin.settings.destroy', $setting],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete Setting',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th> Key </th><td> {{ $setting->key }} </td>
                                    </tr>
                                    <tr>
                                        <th> {{ __('Value') }} </th><td> {{ $setting->value }} </td>
                                    </tr>
                                    <tr>
                                        <th> {{ __('Usage') }} </th><td> <code>setting('{{ $setting->key }}')</code> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
