@extends('Front.Client.Master')

@section('title')
    {{ $title }}
@stop

@section('navbar')
    @include('Front.Partials.NavBarEvent')
@stop

@section('header-scripts')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@stop
@section('content')
    <div class="main main-raised profile-page-wrapper">
        <div class="profile-content">

            <form class="form" method="POST" action="{{ route('updateClient') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="container">
                    <div class="row">
                        <div class="col-xs-6 col-xs-offset-3 text-center">
                            <div class="profile">
                                <div class="avatar">
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail img-circle img-raised">
                                            <img src="{{ $client['image_path']['240*240'] }}" alt="{{ $client['first_name'] }}">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail img-circle img-raised"></div>
                                        <div>
                                            <span class="btn btn-raised btn-round btn-default btn-file">
                                                <span class="fileinput-new">Change Avatar</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input type="file" name="user_image" accept="image/png,image/jpg,image/jpeg"/>
                                            </span>
                                            <br />
                                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput">
                                                <i class="fa fa-times"></i> Remove
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="name">
                                    <h3 class="title">{{ $client['first_name'] . ' ' . $client['last_name'] }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="form-group label-floating">
                                <label class="control-label">First Name</label>
                                <input type="text" name="first_name" value="{{ $client['first_name'] }}" class="form-control" />
                                <span class="error-help"></span>
                                <span class="form-control-feedback">
                                    <i class="material-icons">done</i>
                                </span>
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label">Last Name</label>
                                <input type="text" name="last_name" value="{{ $client['last_name'] }}" class="form-control" />
                                <span class="error-help"></span>
                                <span class="form-control-feedback">
                                    <i class="material-icons">done</i>
                                </span>
                                <span class="error-help"></span>
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label">Date of Birth</label>
                                <input id="clientdob" type="text" name="dob" value="{{ $client['dob'] }}" class="form-control dobpicker" placeholder="Date of Birth">
                                <span class="error-help"></span>
                                <span class="form-control-feedback">
                                    <i class="material-icons">done</i>
                                </span>
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label">Address</label>
                                <input type="text" name="address" value="{{ $client['address'] }}" class="form-control" />
                                <span class="error-help"></span>
                                <span class="form-control-feedback">
                                    <i class="material-icons">done</i>
                                </span>
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label">Phone</label>
                                <input type="text" name="phone" value="{{ $client['phone'] }}" class="form-control" />
                                <span class="error-help"></span>
                                <span class="form-control-feedback">
                                    <i class="material-icons">done</i>
                                </span>
                            </div>
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-round">Save</button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
@section('footer')
    @include('Front.Partials.Footer')
@stop
