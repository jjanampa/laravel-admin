@extends('admin::layouts.app', ['titlePage' => __('Activity Logs')])

@section('content')
    <div class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">{{ __('Activity Logs') }}</h4>
                        <p class="card-category"> {{ __('Here you can manage activity logs') }}</p>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['method' => 'GET', 'route' => 'admin.activitylogs.index' , 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                            <span class="input-group-append">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        {!! Form::close() !!}

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>ID</th>
                                        <th>{{ __('Activity') }}</th>
                                        <th>{{ __('Actor') }}</th>
                                        <th>{{ __('Date') }}</th>
                                        <th class="text-right">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($activitylogs as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>
                                            @if ($item->causer)
                                                <a href="{{ route('admin.users.show', $item->causer) }}">{{ $item->causer->name }}</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $item->created_at }}</td>
                                        <td class="text-right">
                                            <a href="{{ route('admin.activitylogs.show', $item) }}" title="View Activity"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['admin.activitylogs.destroy', $item],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'Delete Activity',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
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
@endsection
