@extends('Front.Master')

@section('title')
    @parent
    Welcome to Vitee
@stop

@section('header-scripts')

    <script>
            /** Animate Text on Video intro **/
            function dataWord () {
                $("[data-words]").attr("data-words", function(i, d){
                    var $self  = $(this),
                            $words = d.split("|"),
                            tot    = $words.length,
                            c      = 0;
                    // CREATE SPANS INSIDE SPAN
                    for(var i=0; i<tot; i++) $self.append($('<span/>',{text:$words[i]}));
                    // COLLECT WORDS AND HIDE
                    $words = $self.find("span").hide();
                    // ANIMATE AND LOOP
                    (function loop(){
                        $self.animate({ width: $words.eq( c ).width() });
                        $words.stop().fadeOut().eq(c).fadeIn().delay(1000).show(0, loop);
                        c = ++c % tot;
                    }());
                });
            }
            $(window).on("load", dataWord);
    </script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-infinitescroll/2.0b2.120519/jquery.infinitescroll.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/masonry/3.1.2/masonry.pkgd.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/3.0.4/jquery.imagesloaded.min.js"></script>

    <script>
        function processUserLocation(city, country) {
            var route = $('#events-around').attr('data-cat-route');
            $('#events-around').attr('data-cat-route', route + city + '/' + country);
        }
        function getUserLocation(precessUserLocation) {
            $.ajax({
                url: "https://geoip-db.com/jsonp",
                jsonpCallback: "callback",
                dataType: "jsonp",
                success: function( location ) {
                    precessUserLocation(location.city, location.country_name);
                }
            });
        }
        getUserLocation(processUserLocation);
    </script>

@stop

@section('navbar')
    @include('Front.Partials.NavBar')
@stop

@section('content')

	<div class="page-header header-filter" data-parallax="true">

        <div class="container">
	        <div class="row">
				<div class="col-lg-10">
					<h1 id="vt-video-text " class="title">Let The <span data-words="Fun|Art|Game|Magic|Race|Adventure|Joy|Party|Festival"></span> Begin!</h1>
					<div class="col-md-6">
						<h4><i class="material-icons vt-color" style="font-size: 18px;">gps_fixed</i> Find your favorite event</h4>
						<h4><i class="fa fa-ticket vt-color" ></i> Get your tickets</h4>
						<h4><i class="material-icons vt-color" style="font-size: 18px;">sentiment_very_satisfied</i> Have fun!</h4>
					</div>
				</div>
	        </div>
	    </div>
    </div>

    <div class="main main-raised vt-bg-lite">
		<div class="container">
			<div class="vt-top-filters">
				<ul class="nav nav-pills nav-pills-icons nav-pills-danger" role="tablist">
					<li class="active">
						<a class="events-filter" data-cat-route="{{ route("home") }}" id="events-all" role="tab"  data-toggle="tab">
							<i class="material-icons">dashboard</i>
							All
						</a>
					</li>
					<li>
						<a class="events-filter" data-cat-route="{{ route("home") . '/events/around/' }}" id="events-around" role="tab" data-toggle="tab">
							<i class="material-icons">person_pin_circle</i>
							Around You
						</a>
					</li>
					<li>
						<a class="events-filter" data-cat-route="{{ route("latestEvents") }}" id="events-latest" role="tab" data-toggle="tab">
							<i class="material-icons">schedule</i>
							Latest
						</a>
					</li>
					<li>
						<a class="events-filter" data-cat-route="{{ route("popularEvents") }}" id="events-popular" role="tab" data-toggle="tab">
							<i class="material-icons">whatshot</i>
							Popular
						</a>
					</li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" >
							<i class="material-icons">list</i>
							Category
						</a>
						<ul class="dropdown-menu ">
                            @foreach($categories as $category)
                                <li><a class="events-filter" id="{{ $category['name_slug'] }}" data-cat-route="{{ route("getCategoryEvents", $category['id']) }}">{{ $category['name'] }}</a></li>
                            @endforeach
						</ul>
					</li>
				</ul>
			</div>

            <div id="masonry-grid">
                @include('Front.Home.Partials.MasonryGrid')
            </div>

            <div id="loading-spin">
                <img src="../front/img/loader.gif"/>
            </div>

	    </div>
	</div>
@stop

@section('footer')
	@include('Front.Partials.Footer')
@stop