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
                                    <li class="active">
                                        <a href="#public" role="tab" data-toggle="tab">
                                            <i class="material-icons">visibility</i>
                                            Public Info
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#notifications" role="tab" data-toggle="tab">
                                            <i class="material-icons">notifications_active</i>
                                            Notifications
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#followings" role="tab" data-toggle="tab">
                                            <i class="material-icons">grade</i>
                                            Following
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#categories" role="tab" data-toggle="tab">
                                            <i class="material-icons">favorite</i>
                                            Favorites
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- End Profile Tabs -->
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active work" id="public">
                        <div class="row">
                            <div class="col-md-7 col-md-offset-1">
                                <h5>Your Public Info: </h5>
                                <form class="form" method="POST" action="{{ route('updateClientPreferences') }}">
                                    {{ csrf_field() }}
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="email" {{ $meta['show_email'] ? 'checked' : '' }}>
                                            Email
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="gender" {{ $meta['show_gender'] ? 'checked' : '' }}>
                                            Gender
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="phone" {{ $meta['show_phone'] ? 'checked' : '' }}>
                                            Phone
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="address" {{ $meta['show_address'] ? 'checked' : '' }}>
                                            Address
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="followings" {{ $meta['show_followings'] ? 'checked' : '' }}>
                                            Followed Organisers
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="favorites" {{ $meta['show_favorites'] ? 'checked' : '' }}>
                                            Favorites Categories
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="likes" {{ $meta['show_likes'] ? 'checked' : '' }}>
                                            Liked Events
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="attended" {{ $meta['show_attended_events'] ? 'checked' : '' }}>
                                            Attended Events
                                        </label>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-round">Save</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-2 col-md-offset-1 stats">
                                <h4 class="title">Stats</h4>
                                <ul class="list-unstyled">
                                    <li><b>{{ $counters['followings'] }}</b> Organiser Followed</li>
                                    <li><b>{{ $counters['favorites'] }}</b> Favorite Category </li>
                                    <li><b>{{ $counters['likes'] }}</b> Liked Events</li>
                                    <li><b> 0 </b> Attended Events</li>
                                </ul>
                                @if($counters['favorites'] !== 0)
                                <hr />
                                <h4 class="title">Favorites</h4>
                                @foreach($categories as $key=>$category) <?php ++$key ?>
                                <span class="label label-{{ $key % 2 !== 0 ? 'rose' : 'info'}}">{{ $category['name'] }}</span>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane connections" id="notifications">
                        <form class="form" method="POST" action="{{ route('updateClientNotificationsPreferences') }}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-10 col-md-offset-2">
                                    <div class="togglebutton">
                                        <label>
                                            <input type="checkbox" name="notif_email" {{ $meta['get_mail_notif'] ? 'checked=""' : '' }}>
                                            <p>Mail Notifications</p>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-2">
                                    <h5><b>Get notified about new events posted:</b></h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-2">
                                    <div class="togglebutton">
                                        <label>
                                            <input type="checkbox" name="notif_followings" {{ $meta['get_notif_about_followings'] ? 'checked=""' : '' }}>
                                            <p>By your followed organiser</p>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-2">
                                    <div class="togglebutton">
                                        <label>
                                            <input type="checkbox" name="notif_favorites" {{ $meta['get_notif_about_favorites'] ? 'checked=""' : '' }}>
                                            <p>In your favorite categories</p>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-round">Save</button>
                            </div>
                        </form>
                    </div>


                    @if(!empty($organisers))
                    <div class="tab-pane text-center gallery" id="followings">
                        <div class="row collections">
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
                                <h2>you haven't followed any organisers yet!</h2>
                            </div>
                        </div>
                    @endif

                    @if(!empty($categories))
                        <div class="tab-pane text-center gallery" id="categories">
                            <div class="row collections">
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
                        <div class="tab-pane text-center gallery" id="followings">
                            <div class="row collections">
                                <h2>you haven't followed any organisers yet!</h2>
                            </div>
                        </div>
                    @endif


                </div>
            </div>
        </div>
    </div>
@stop
@section('footer')
    @include('Front.Partials.Footer')
@stop
