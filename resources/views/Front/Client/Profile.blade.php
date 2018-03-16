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
            <div class="container">
                <div class="row">
                    <div class="col-xs-6 col-xs-offset-3 text-center">
                        <div class="profile">
                            <div class="avatar">
                                <img src="{{ $client['image_path']['240*240'] }}" alt="Circle Image" class="img-circle img-responsive img-raised client-profile-avatar">
                            </div>
                            <div class="name">
                                <h3 class="title">{{ $client['first_name'] . ' ' . $client['last_name'] }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <span id="route" data-route="{{ route('updateClient') }}" style="display: none;"></span>
                        <div class="form-group label-floating">
                            <label class="control-label">First Name</label>
                            <input type="text" name="first_name" value="{{ $client['first_name'] }}" class="form-control client-inputs" />
                            <span class="error-help"></span>
                            <span class="form-control-feedback">
                                <i class="material-icons">done</i>
                            </span>
                        </div>
                        <div class="form-group label-floating">
                            <label class="control-label">Last Name</label>
                            <input type="text" name="last_name" value="{{ $client['last_name'] }}" class="form-control client-inputs" />
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
                            <input type="text" name="address" value="{{ $client['address'] }}" class="form-control client-inputs" />
                            <span class="error-help"></span>
                            <span class="form-control-feedback">
                                <i class="material-icons">done</i>
                            </span>
                        </div>
                        <div class="form-group label-floating">
                            <label class="control-label">Phone</label>
                            <input type="text" name="phone" value="{{ $client['phone'] }}" class="form-control client-inputs" />
                            <span class="error-help"></span>
                            <span class="form-control-feedback">
                                <i class="material-icons">done</i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer')
    @include('Front.Partials.Footer')
@stop
