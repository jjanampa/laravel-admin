@extends('admin::layouts.app', ['titlePage' => __('Users')])

@section('content')
    <div class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">{{ __('Add User') }}</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('admin.users.index') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{ __('Back') }}</button></a>
                        <br />
                        <br />
                        <form method="post" action="{{ route('admin.users.store') }}" autocomplete="off" class="form-horizontal">
                            @csrf
                            @include ('admin::dashboard.users.form', ['formMode' => 'create'])
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
