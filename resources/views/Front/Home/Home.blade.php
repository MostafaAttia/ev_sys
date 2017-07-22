@extends('Front.Master')

@section('title')
    @parent
    Welcome to Vitee
@stop

@section('header-scripts')

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-infinitescroll/2.0b2.120519/jquery.infinitescroll.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/masonry/3.1.2/masonry.pkgd.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/3.0.4/jquery.imagesloaded.min.js"></script>

@stop

@section('navbar')
    @include('Front.Partials.NavBar')
@stop

@section('content')

	<div class="page-header header-filter" data-parallax="true">

        <div class="container">
	        <div class="row">
				<div class="col-lg-10">
					<h1 id="vt-video-text " class="title">Let The <span data-words="Fun|Art|Game|Magic|Race|Adventure|Joy|Party|Journey|Festival"></span> Begin!</h1>
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
					<li>
						<a href="#all" role="tab" data-toggle="tab">
							<i class="material-icons">dashboard</i>
							All
						</a>
					</li>
					<li>
						<a href="#around" role="tab" data-toggle="tab">
							<i class="material-icons">person_pin_circle</i>
							Around You
						</a>
					</li>
					<li class="active">
						<a href="#latest" role="tab" data-toggle="tab">
							<i class="material-icons">schedule</i>
							Latest
						</a>
					</li>
					<li>
						<a href="#popular" role="tab" data-toggle="tab">
							<i class="material-icons">whatshot</i>
							Popular
						</a>
					</li>
					<li class="dropdown">
						<a href="#category" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" >
							<i class="material-icons">list</i>
							Category
						</a>
						<ul class="dropdown-menu ">
							<li><a href="#art">Art & Theatre</a></li>
							<li><a href="#exhibitions">Exhibitions</a></li>
							<li><a href="#networking">Networking & Social</a></li>
							<li><a href="#nightlife">Nightlife</a></li>
							<li><a href="#food">Food & Dining</a></li>
							<li><a href="#sport">Sport</a></li>
						</ul>
					</li>
				</ul>
			</div>
            <div id="masonry-grid">
                @foreach($events['data'] as $event)
                    <div class="grid-sizer"></div>
                    <div class="grid-item">
                        <div class="card card-blog card-rotate">
                            <div class="rotating-card-container">
                                <div class="card-image">
                                    <div class="front">
                                        <img class="img" src="{{ $event['image_path']['original'] }}"/>
                                    </div>
                                    <div class="back back-background">
                                        <div class="card-content">
                                            <h5 class="card-title">
                                                Share this event...
                                            </h5>
                                            <p class="card-description">
                                                You can share this event with your friends, family or on different networks...
                                            </p>
                                            <div class="footer text-center">
                                                <a href="#pablo" class="btn btn-just-icon btn-round btn-white btn-twitter">
                                                    <i class="fa fa-twitter"></i>
                                                </a>
                                                <a href="#pablo" class="btn btn-just-icon btn-round btn-white btn-pinterest">
                                                    <i class="fa fa-pinterest"></i>
                                                </a>
                                                <a href="#pablo" class="btn btn-just-icon btn-round btn-white btn-facebook">
                                                    <i class="fa fa-facebook"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-content">
                                <h4 class="card-title">
                                    <a href="{{ route('showEventPage', $event['id']) }}">{{ $event['title'] }}</a>
                                </h4>
                                <p class="card-description">
                                    {{ str_limit($event['desc'], $limit = 200, $end = '...') }}
                                </p>
                                <div class="footer">
                                    <div class="author">
                                        <a href="#pablo">
                                           <img src="{{ $event['organiser']['image_path']['original'] }}" alt="..." class="avatar img-raised">
                                           <span>{{ $event['organiser']['name'] }}</span>
                                        </a>
                                    </div>
                                   <div class="stats">
                                       <i class="material-icons">favorite</i> 142 &middot;
                                       <i class="material-icons">chat_bubble</i> 45
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="navigation">
                <div class="nav-next">
                    <a href="{{ $events['next_page_url'] }}"></a>
                </div>
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