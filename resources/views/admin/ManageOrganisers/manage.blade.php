@extends('admin.dashboard')

@section('content')

    <div>
        @if (session()->has('admin_message'))
            <div class="alert alert-success text-center" id="success-alert">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>{{ session()->get('admin_message') }}</strong>
            </div>
        @endif
    </div>
    <div>

        <table id="adminsTable" class="display" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>About</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($organisers as $organiser)
                <tr>
                    <td>{{ $organiser->id }}</td>
                    <td>{{ $organiser->name }}</td>
                    <td>{{ $organiser->email }}</td>
                    <td> <span data-toggle="tooltip" data-placement="right" title="{{ $organiser->about }}"> {{ str_limit($organiser->about, $limit = 20, $end = '...')  }} </span> </td>
                    <td>
                        <a href=" {{ route('admin.edit', ['id'=> $organiser->id]) }} " class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-edit"></span> Edit</a> &nbsp;
                    </td>
                    <td>
                        {!! Form::open(['method' => 'delete', 'route' => ['organiser.delete', $organiser->id] ]) !!}
                        {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> &nbsp; Delete', array('type' => 'submit', 'class' => 'btn btn-sm btn-danger')) !!}
                        {!! Form::close() !!}
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>

    </div>


@endsection