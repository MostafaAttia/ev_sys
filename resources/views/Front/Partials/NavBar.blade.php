<nav class="animated bounceInDown navbar navbar-default navbar-fixed-top navbar-transparent navbar-color-on-scroll" style="padding:0"  role="navigation" color-on-scroll="200">
	<div class="container">
    	<div class="navbar-header ">
    		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example">
        		<span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
    		</button>
    		<a class="navbar-brand vt-logo" href="/home">Vitee</a>
    	</div>

    	<div class="collapse navbar-collapse">
    		<ul class="nav navbar-nav navbar-right">
                @if(! Auth::guard('client')->user())
				<li>
					<a href="#login" data-toggle="modal" data-target="#loginModal">
						<i class="fa fa-sign-in vt-color"></i> Login
					</a>
                    <div class="ripple-container"></div>
				</li>

				<li>
					<a href="#signup" data-toggle="modal" data-target="#signupModal">
						<i class="fa fa-user-plus vt-color"></i> Signup
					</a>
				</li>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<i class="material-icons vt-color">event</i> Event Organizers 
						<b class="caret"></b>
					<div class="ripple-container"></div></a>
					<ul class="dropdown-menu dropdown-with-icons">
						<li>
							<a href="{{ route('login') }}">
								<i class="fa fa-sign-in vt-color"></i> Login
							</a>
						</li>
						<li>
							<a href="{{ route('showSignup') }}">
								<i class="fa fa-user-plus vt-color"></i> Join Us
							</a>
						</li>
					</ul>
				</li>
                @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" style="padding-bottom: 0px;" data-toggle="dropdown" aria-expanded="false">
                        <img src="{{ $client['image_path']['original'] }}" alt="{{ $client['first_name'] .'\' image' }}" class="client-avatar"/>
                        {{ $client['first_name'] }}
                        <b class="caret"></b>
                        <div class="ripple-container"></div>
                    </a>
                    <ul class="dropdown-menu dropdown-with-icons">
                        <li>
                            <a href="../sections.html#headers">
                                <i class="fa fa-sign-in vt-color"></i> Profile
                            </a>
                        </li>
                        <li>
                            <a href="../sections.html#features">
                                <i class="fa fa-user-plus vt-color"></i> Settings
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ url('/home/logout') }}" >
                                <i class="fa fa-user-plus vt-color"></i> Logout
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
    		</ul>
    	</div>
	</div>
</nav>

@if (Session::has('notification'))
    <script>
        new Noty({
            text: '{{ Session::get('notification')['content'] }}',
            type: '{{ Session::get('notification')['type'] }}',
            layout: 'topRight',
            theme: 'metroui',
            timeout: 5000,
            progressBar: true,
            closeWith: ['click', 'button'],
            animation: {
                open: 'animated bounceInRight',
                close: 'animated bounceOutRight'
            },
            queue: 'global'
        }).show();
    </script>
@endif

@include('Front.Home.Modals.Login')
@include('Front.Home.Modals.Signup')
