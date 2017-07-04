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
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Last Login</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($admins as $admin)
                <tr>
                    <td>{{ $admin->id }}</td>
                    <td>{{ $admin->first_name }}</td>
                    <td>{{ $admin->last_name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>
                    @foreach($admin->getRoles() as $role)
                         @if($role->slug == 'super_admin') <i class="fa fa-key"></i> @endif
                         {{ $role->name }}
                    @endforeach
                    </td>
                    <td>{{ $admin->last_login }}</td>
                    <td>
                        <a href=" {{ route('admin.edit', ['id'=> $admin->id]) }} " class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-edit"></span> Edit</a> &nbsp;

                        {{--<button class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</button>--}}
                    </td>
                    <td>
                        {!! Form::open(['method' => 'delete', 'route' => ['admin.delete', $admin->id] ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> &nbsp; Delete', array('type' => 'submit', 'class' => 'btn btn-sm btn-danger')) !!}
                        {!! Form::close() !!}
                    </td>

                </tr>
               @endforeach
            </tbody>
        </table>

    </div>


@endsection