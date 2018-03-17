@extends('Front.Client.SettingsMaster')

@section('title')
    Categories
@stop

@section('navbar')
    @include('Front.Partials.NavBar')
@stop
@section('header-scripts')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@stop
@section('content')
    <div class="page-header header-filter" data-parallax="true" style="background-image: url('{{ asset("front/img/categories/all.jpg") }}'); background-position: bottom"></div>

    <div class="main main-raised">
        <div class="profile-content">
            <div class="container">

                <div class="row categories-wrapper">
                    @foreach($categories as $category)
                        <div class="col-md-6 category-card">
                            <div class="card card-background" style=" background-image: url('{{ $category['image_path'] }}')">
                                @if(Auth::guard('client')->user())
                                <div class="col-xs-2 follow">
                                    <button data-favorite-route="{{ route('favorite', $category['id']) }}"
                                            data-unfavorite-route="{{ route('unfavorite', $category['id']) }}"
                                            class="btn btn-fab {{ in_array($category['id'], $favorites) ? 'btn-primary': 'btn-default'}} favorite_category" rel="tooltip"
                                            title="{{ in_array($category['id'], $favorites) ? 'Unfavorite': 'Favorite'}}">
                                        <i class="material-icons">favorite</i>
                                    </button>
                                </div>
                                @endif
                                <div class="card-content">
                                    <a href="{{route('showCategory', $category['id'])}}">
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
        </div>
    </div>
@stop
@section('footer')
    @include('Front.Partials.Footer')
@stop
