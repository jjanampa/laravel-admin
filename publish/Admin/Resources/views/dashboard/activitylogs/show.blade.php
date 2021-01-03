@extends('admin::layouts.app', ['titlePage' => __('Activity Logs')])

@section('content')
    <div class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">{{ __('Show Activity Logs') }} {{ $activitylog->id }}</h4>
                    </div>
                    <div class="card-body">

                        <a href="{{ route('admin.activitylogs.index')}}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{ __('Back') }}</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'route' => ['admin.activitylogs.destroy', $activitylog],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete Activity',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $activitylog->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> {{ __('Activity') }} </th><td> {{ $activitylog->description }} </td>
                                    </tr>
                                    <tr>
                                        <th> {{ __('Actor') }} </th>
                                        <td>
                                            @if ($activitylog->causer)
                                                <a href="{{ route('admin.users.show', $activitylog->causer) }}">{{ $activitylog->causer->name }}</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> {{ __('Date') }} </th><td> {{ $activitylog->created_at }} </td>
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
