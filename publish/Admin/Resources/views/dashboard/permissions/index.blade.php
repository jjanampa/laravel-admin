@extends('admin::layouts.app', ['titlePage' => __('Permissions')])

@section('content')
    <div class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">{{ __('Permissions') }}</h4>
                        <p class="card-category"> {{ __('Here you can manage permissions') }}</p>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('admin.permissions.create') }}" class="btn btn-success btn-sm" title="Add New Permission">
                            <i class="fa fa-plus" aria-hidden="true"></i> {{ __('Add New') }}
                        </a>

                        {!! Form::open(['method' => 'GET', 'route' => 'admin.permissions.index', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search...">
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
                            <table class="table">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>ID</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Label') }}</th>
                                        <th class="text-right">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($permissions as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td><a href="{{ route('admin.permissions.show', $item) }}">{{ $item->name }}</a></td><td>{{ $item->label }}</td>
                                        <td class="text-right">
                                            <a href="{{ route('admin.permissions.show', $item) }}" title="View Permission"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                            <a href="{{ route('admin.permissions.edit', $item) }}" title="Edit Permission"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['admin.permissions.destroy', $item],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'Delete Permission',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination"> {!! $permissions->appends(['search' => Request::get('search')])->links() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
