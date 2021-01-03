@extends('admin::layouts.app', ['titlePage' => __('Users')])

@section('content')
    <div class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">{{ __('Show User') }}</h4>
                    </div>
                    <div class="card-body">

                        <a href="{{ route('admin.users.index') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{ __('Back') }}</button></a>
                        <a href="{{ route('admin.users.edit', $user) }}" title="Edit User"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> {{ __('Edit') }}</button></a>
                        {!! Form::open([
                            'method' => 'DELETE',
                            'route' => ['admin.users.destroy', $user],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete User',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card card-nav-tabs text-center">
                                    <h4 class="card-header card-header-warning">{{ __('Profile') }}</h4>
                                    <div class="card-body">
                                        <h4 class="card-title"><i class="fa fa-user fa-2x" aria-hidden="true"></i> {{ $user->id }} - {{ $user->name }}</h4>
                                        <h6 class="card-subtitle mb-2 text-muted">{{ $user->email }}</h6>
                                        <p class="card-text">Rol:
                                            @foreach ($user->roles as $role)
                                                <span class="badge badge-pill badge-dark">{{ $role->name }}</span>
                                            @endforeach
                                        </p>

                                    </div>
                                </div>

                            </div>
                            <div class="col-md-8">
                                <div class="card card-nav-tabs text-center">
                                    <h4 class="card-header card-header-warning">{{ __('Activity Logs') }}</h4>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <thead class=" text-primary">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>{{ __('Activity') }}</th>
                                                    <th>{{ __('Date') }}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($activitylogs as $item)
                                                    <tr>
                                                        <td>{{ $item->id }}</td>
                                                        <td>{{ $item->description }}</td>
                                                        <td>{{ $item->created_at }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            <div class="pagination-wrapper"> {!! $activitylogs->appends(['search' => Request::get('search')])->links() !!} </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
