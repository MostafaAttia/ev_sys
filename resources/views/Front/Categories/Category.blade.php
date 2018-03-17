@extends('Front.Master')

@section('title')
    Categories
@stop

@section('navbar')
    @include('Front.Partials.NavBar')
@stop
@section('header-scripts')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-infinitescroll/2.0b2.120519/jquery.infinitescroll.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/masonry/3.1.2/masonry.pkgd.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/3.0.4/jquery.imagesloaded.min.js"></script>
@stop
@section('content')

    <div class="page-header header-filter header-small" data-parallax="true" style="background-image: url('{{ asset($category['image_path']) }}');">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="brand">
                        <h1 class="title" style="display: inline-block;">{{ $category['name'] }}</h1>
                        @if(Auth::guard('client')->user())
                                <button data-favorite-route="{{ route('favorite', $category['id']) }}"
                                        data-unfavorite-route="{{ route('unfavorite', $category['id']) }}"
                                        class="btn btn-fab {{ in_array($category['id'], $favorites) ? 'btn-primary': 'btn-default'}} favorite_category " rel="tooltip"
                                        title="{{ in_array($category['id'], $favorites) ? 'Unfavorite': 'Favorite'}}"
                                        style="vertical-align: baseline;">
                                    <i class="material-icons">favorite</i>
                                </button>
                        @endif
                        <h4>Find your next event in more than <b>{{ $category['events'] }}</b> events . Be one of <b>{{ $category['fans'] }}</b> fans</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main main-raised">
        <div class="profile-content">
            <div class="container">
                <div class="row categories-wrapper">

                    <div id="masonry-grid">
                        @include('Front.Home.Partials.MasonryGrid')
                    </div>

                    <div id="loading-spin">
                        <img src="{{ asset('front/img/loader.gif') }}"/>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {!!  HTML::script(config('attendize.cdn_url_static_assets').'/front/js/client-profile.js') !!}
@stop
@section('footer')
    @include('Front.Partials.Footer')
@stop
