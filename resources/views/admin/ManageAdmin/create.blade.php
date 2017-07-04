@extends('admin.dashboard')

@section('content')
    @if (session()->has('admin_created'))
        <div class="alert alert-success text-center" id="success-alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{ session()->get('admin_created') }}</strong>
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">

                        {!! Form::open(array('url' => route('admin.create.post'), 'class' => 'form-horizontal')) !!}

                            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                {!! Form::label('first_name', 'First Name', array('class'=>'col-md-4 control-label')) !!}

                                <div class="col-md-6">
                                    {!!  Form::text('first_name', Input::old('first_name'),array('class'=>'form-control',  'autofocus'=>'autofocus', 'required'=>'true'))  !!}
                                    @if ($errors->has('first_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                {!! Form::label('last_name', 'Last Name', array('class'=>'col-md-4 control-label')) !!}

                                <div class="col-md-6">
                                    {!!  Form::text('last_name', Input::old('last_name'),array('class'=>'form-control', 'required'=>'true'))  !!}
                                    @if ($errors->has('last_name'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('last_name') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                {!! Form::label('email', 'E-Mail Address', array('class'=>'col-md-4 control-label')) !!}
                                <div class="col-md-6">
                                    {!!  Form::text('email', Input::old('email'),array('class'=>'form-control ','placeholder'=>'', 'required'=>'true'))  !!}
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                {!! Form::label('password', 'Password', array('class'=>'col-md-4 control-label')) !!}
                                <div class="col-md-6">
                                    {!! Form::password('password', ['class' => 'form-control', 'required'=>'true']) !!}
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                {!! Form::label('password-confirm', 'Confirm Password', array('class'=>'col-md-4 control-label')) !!}

                                <div class="col-md-6">
                                    {!! Form::password('password_confirmation', ['class' => 'form-control', 'id'=> 'password-confirm', 'required'=>'true']) !!}
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                {!! Form::label('role_id', 'Role', array('class'=>'col-md-4 control-label')) !!}
                                <div class="col-md-6">
                                    {{--{!! Form::select('role_id', ['' => 'Choose Role'] + $roles , null , ['class' => 'form-control', 'id'=> 'role', 'required'=>'true']) !!}--}}
                                    {!! Form::select('role_id', ['' => 'Choose Role'] + $roles , null , ['class' => 'form-control', 'id'=> 'role', 'required'=>'true']) !!}
                                    @if ($errors->has('role'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('role') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i> Register
                                    </button>
                                </div>
                            </div>

                        {!! Form::close() !!}












                        {{--<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/create') }}">--}}
                            {{--{{ csrf_field() }}--}}

                            {{--<div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">--}}
                                {{--<label for="first_name" class="col-md-4 control-label">First Name</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" autofocus>--}}

                                    {{--@if ($errors->has('first_name'))--}}
                                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('first_name') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">--}}
                                {{--<label for="last_name" class="col-md-4 control-label">Last Name</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">--}}

                                    {{--@if ($errors->has('last_name'))--}}
                                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('last_name') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}



                            {{--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">--}}
                                {{--<label for="email" class="col-md-4 control-label">E-Mail Address</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">--}}

                                    {{--@if ($errors->has('email'))--}}
                                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">--}}
                                {{--<label for="password" class="col-md-4 control-label">Password</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="password" type="password" class="form-control" name="password">--}}

                                    {{--@if ($errors->has('password'))--}}
                                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">--}}
                                {{--<label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="password-confirm" type="password" class="form-control" name="password_confirmation">--}}

                                    {{--@if ($errors->has('password_confirmation'))--}}
                                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('password_confirmation') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">--}}
                                {{--<label for="role" class="col-md-4 control-label">E-Mail Address</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="role" type="checkbox" class="form-control" name="role" value="{{ old('role') }}">--}}

                                    {{--@if ($errors->has('role'))--}}
                                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('role') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}


                            {{--<div class="form-group">--}}
                                {{--<div class="col-md-6 col-md-offset-4">--}}
                                    {{--<button type="submit" class="btn btn-primary">--}}
                                        {{--<i class="fa fa-btn fa-user"></i> Register--}}
                                    {{--</button>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</form>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
