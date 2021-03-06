<!DOCTYPE html>
<html lang="en">
    <head>

        <title>{{{$organiser->name}}} - Vitee</title>


        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0" />

        <!--     Fonts and icons     -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

        <!-- Open Graph data -->
        <meta property="og:title" content="{{{$organiser->name}}}" />
        <meta property="og:type" content="article" />
        <meta property="og:url" content="{{URL::to('')}}" />
        <meta property="og:image" content="{{URL::to($organiser->full_logo_path)}}" />
        <meta property="og:description" content="{{{Str::words(strip_tags($organiser->description)), 20}}}" />
        <meta property="og:site_name" content="Attendize.com" />
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

       {!!HTML::style('assets/stylesheet/frontend.css')!!}

        <!-- CSS Files -->
        {!!HTML::style('front/css/bootstrap.min.css')!!}
        {!!HTML::style('front/css/material-kit.css?v=1.1.0')!!}
        {!!HTML::style('front/css/noty.css')!!}
        {!!HTML::style('front/css/animate.min.css')!!}
        {!!HTML::style('front/css/custom.css')!!}

        {!!HTML::script('assets/javascript/frontend.js')!!}
        {!!  HTML::script('/front/js/material.min.js') !!}

        @yield('head')
    </head>
    <body class="attendize">
        @include('Front.Partials.NavBarEvent')

        @include('Shared.Partials.FacebookSdk')
        <div id="organiser_page_wrap">
            @yield('content')
        </div>

        <a href="#intro" style="display:none;" class="totop"><i class="ico-angle-up"></i>
            <span style="font-size:11px;">TOP</span>
        </a>


        @include('Front.Partials.core-scripts')
        @include('Front.Home.Modals.Modals')

        @include('Shared.Partials.GlobalFooterJS')
        @yield('foot')
        @include('Front.Partials.Shared-Javascript')
</body>
</html>
