@extends('admin::layouts.app', ['titlePage' => __('Pages')])

@section('content')
    <div class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">{{ __('Edit Page') }} #{{ $page->id }}</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('admin.pages.index') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{ __('Back') }}</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($page, [
                            'method' => 'PATCH',
                            'route' => ['admin.pages.update', $page],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('admin::dashboard.pages.form', ['formMode' => 'edit'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
