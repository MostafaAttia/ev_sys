<!doctype html>
<html lang="en">
<head>
	<title>
		@section('title')
            Vitee ::
        @show
	</title>

	<meta charset="utf-8" />
	{{-- <link rel="apple-touch-icon" sizes="76x76" href="front/img/apple-icon.png"> --}}
	<link rel="apple-touch-icon" sizes="76x76" href="front/img/favicon.ico">
	<link rel="icon" type="image/png" href="front/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

	<!-- CSS Files -->
    {!!HTML::style('front/css/bootstrap.min.css')!!}
    {!!HTML::style('front/css/material-kit.css?v=1.1.0')!!}
    {!!HTML::style('front/css/vegas.min.css')!!}
    {!!HTML::style('front/css/noty.css')!!}
    {!!HTML::style('front/css/animate.min.css')!!}
    {!!HTML::style('front/css/custom.css')!!}

    @include('Front.Partials.core-header-scripts')
    @yield('header-scripts')
</head>

<body class="vt-overflow-x-hidden">

	@yield('navbar')

	@yield('content')

    @yield('footer')

    @yield('footer-scripts')

    @include('Front.Partials.core-scripts')
    @include('Front.Home.Modals.Modals')

    {!!  HTML::script(config('attendize.cdn_url_static_assets').'/front/js/vt-custom.js') !!}
</body>
</html>
