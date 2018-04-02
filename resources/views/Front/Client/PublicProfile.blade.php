@extends('Front.Client.SettingsMaster')

@section('title')
    {{ $title }}
@stop

@section('navbar')
    @include('Front.Partials.NavBar')
@stop
@section('header-scripts')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@stop
@section('content')
    <div class="page-header header-filter" data-parallax="true" style="background-image: url('{{ asset("front/img/city.jpg") }}');"></div>
    <div class="main main-raised">
        <div class="profile-content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-6 col-xs-offset-3">
                        <div class="profile">
                            <div class="avatar">
                                <img src="{{ $client['image_path']['240*240'] }}" alt="Circle Image" class="img-circle img-responsive img-raised">
                            </div>
                            <div class="name">
                                <h3 class="title">{{ $client['first_name'] }}  {{ $client['last_name']}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="profile-tabs">
                            <div class="nav-align-center">
                                <ul class="nav nav-pills nav-pills-icons" role="tablist">
                                    @if($meta['show_email'] || $meta['show_gender'] || $meta['show_phone'] || $meta['show_address'] || $meta['show_email'])
                                    <li class="active">
                                        <a href="#public" role="tab" data-toggle="tab">
                                            <i class="material-icons">visibility</i>
                                            User Info
                                        </a>
                                    </li>
                                    @endif
                                    @if($meta['show_followings'])
                                    <li>
                                        <a href="#followings" role="tab" data-toggle="tab">
                                            <i class="material-icons">grade</i>
                                            Following
                                        </a>
                                    </li>
                                    @endif
                                    @if($meta['show_favorites'])
                                    <li>
                                        <a href="#favorites" role="tab" data-toggle="tab">
                                            <i class="material-icons">favorite</i>
                                            Favorites
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <!-- End Profile Tabs -->
                    </div>
                </div>

                <div class="tab-content">
                    @if($meta['show_email'] || $meta['show_gender'] || $meta['show_phone'] || $meta['show_address'] )
                    <div class="tab-pane active work" id="public">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                @if($meta['show_email'])<h3 class="info-title"><i class="fa fa-envelope"></i>  {{ $client['email'] }} </h3> @endif
                                @if($meta['show_gender'])<h3 class="info-title"><i class="fa fa-venus-mars"></i>  {{ $client['gender'] }} </h3> @endif
                                @if($meta['show_phone'])<h3 class="info-title"><i class="fa fa-phone-square"></i>  {{ $client['phone'] }} </h3> @endif
                                @if($meta['show_address'])<h3 class="info-title"><i class="fa fa-map-marker"></i>  {{ $client['address'] }} </h3> @endif
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($meta['show_followings'])
                    @if(!empty($organisers))
                    <div class="tab-pane work" id="followings">
                        <div class="row">
                            @foreach($organisers as $organiser)
                                <div class="col-md-6">
                                    <div class="card card-background" style=" background-image: url('{{ $organiser['image_path']['original'] }}')">
                                        <div class="col-xs-2 follow">
                                            <button data-follow-route="{{ route('follow', $organiser['id']) }}"
                                                    data-unfollow-route="{{ route('unfollow', $organiser['id']) }}"
                                                    class="btn btn-fab btn-primary follow_organiser" rel="tooltip" title="Unfollow this organiser">
                                                <i class="material-icons">star</i>
                                            </button>
                                        </div>
                                        <div class="card-content">
                                            <a href="{{ route('showOrganiserHome', $organiser['id']) }}">
                                                <h2 class="card-title">{{ $organiser['name'] }}</h2>
                                            </a>
                                            <div class="organiser-card-labels">
                                                <label class="label label-danger">{{ $organiser['events'] }} events</label>
                                                <label class="label label-info">{{ $organiser['followers'] }} followers</label>
                                            </div>
                                            <a href="{{ 'https://www.twitter.com/'. $organiser['twitter'] }}" target="_blank">
                                                <button class="btn btn-fab btn-twitter">
                                                    <i class="fa fa-twitter"></i>
                                                </button>
                                            </a>
                                            <a href="{{ 'https://www.facebook.com/'. $organiser['facebook'] }}" target="_blank">
                                                <button class="btn btn-fab btn-facebook">
                                                    <i class="fa fa-facebook"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @else
                        <div class="tab-pane text-center gallery" id="followings">
                            <div class="row collections">
                                <h2>{{ $client['first_name'] }} didn't follow any organisers yet!</h2>
                            </div>
                        </div>
                    @endif
                    @endif

                    @if($meta['show_favorites'])
                    @if(!empty($categories))
                    <div class="tab-pane work" id="favorites">
                        <div class="row">
                            @foreach($categories as $category)
                                <div class="col-md-6">
                                    <div class="card card-background" style=" background-image: url('{{ $category['image_path'] }}')">
                                        <div class="col-xs-2 follow">
                                            <button data-favorite-route="{{ route('favorite', $category['id']) }}"
                                                    data-unfavorite-route="{{ route('unfavorite', $category['id']) }}"
                                                    class="btn btn-fab btn-primary favorite_category" rel="tooltip" title="Unfavorite">
                                                <i class="material-icons">favorite</i>
                                            </button>
                                        </div>
                                        <div class="card-content">
                                            <a href="#">
                                                <h2 class="card-title">{{ $category['name'] }}</h2>
                                            </a>
                                            <div class="organiser-card-labels">
                                                <label class="label label-danger">{{ $category['events'] }} events</label>
                                                <label class="label label-info">{{ $category['fans'] }} fans</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @else
                        <div class="tab-pane text-center gallery" id="favorites">
                            <div class="row collections">
                                <h2>{{ $client['first_name'] }} didn't favor any category yet!</h2>
                            </div>
                        </div>
                    @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer')
    @include('Front.Partials.Footer')
@stop
