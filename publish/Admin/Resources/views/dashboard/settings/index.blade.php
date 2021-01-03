@extends('admin::layouts.app', ['titlePage' => __('Settings')])

@section('content')
    <div class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">{{ __('Settings') }}</h4>
                        <p class="card-category"> {{ __('Here you can manage settings') }}</p>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('admin.settings.create') }}" class="btn btn-success btn-sm" title="Add New Setting">
                            <i class="fa fa-plus" aria-hidden="true"></i> {{ __('Add New') }}
                        </a>

                        {!! Form::open(['method' => 'GET', 'route' => 'admin.settings.index', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="{{ __('Search') }}..." value="{{ request('search') }}">
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
                                        <th>Key</th>
                                        <th>{{ __('Value') }}</th>
                                        <th>{{ __('Usage') }}</th>
                                        <th class="text-right">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($settings as $item)
                                    <tr>
                                        <td>{{ $item->key }}</td>
                                        <td>{{ $item->value }}</td>
                                        <td><code>setting('{{ $item->key }}')</code></td>
                                        <td class="text-right">
                                            <a href="{{ route('admin.settings.show', $item) }}" title="View Setting"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                            <a href="{{ route('admin.settings.edit', $item) }}" title="Edit Setting"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['admin.settings.destroy', $item],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'Delete Setting',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $settings->appends(['search' => Request::get('search')])->links() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
