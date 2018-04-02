    @if(count($events['data']) === 0)

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div id="noCategoryEvents" class="text-center">
                <div class="card card-plain card-blog">
                    <div class="card-image">
                        <img class="img img-raised" src="{{ asset('front/img/NoCategoryEvents.png') }}" />
                    </div>

                    <div class="card-content">
                        <h4 class="card-title">No Events in This Category, Stay Tuned!</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @else

        @foreach($events['data'] as $event)
        <div class="grid-sizer hidden-xs hidden-sm hidden-md col-lg-1"></div>
        <div class="grid-item col-xs-12 col-sm-12 col-md-6 col-lg-4">
            <div class="card card-blog card-rotate">
                <div class="rotating-card-container">
                    <div class="card-image">
                        <div class="front">
                            <img class="img" src="{{ $event['image_path']['original'] }}"/>
                        </div>
                        <div class="back back-background">
                            <div class="card-content">

                                @if($event['venue_name_full'] !== null)
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6 class="category">
                                            <i  class="fa fa-map-marker"></i>
                                            {{ $event['venue_name_full'] }}
                                        </h6>
                                    </div>
                                </div>
                                <hr>
                                @endif
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="category">
                                            <i  class="fa fa-question-circle"></i>
                                            {{ $event['is_activity'] ? 'Activity' : 'Event' }}
                                        </h6>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="category">
                                            <i  class="fa fa-clock-o"></i>
                                            {{ Carbon::createFromFormat('Y-m-d H:i:s', $event['start_date']['date'])->toFormattedDateString() }}
                                        </h6>
                                    </div>
                                </div>
                                <div class="footer text-center">
                                    @if($event['social_show_twitter'] === 1)
                                        <a href="http://twitter.com/intent/tweet?text=Check out: {{$event['event_url']}} {{{Str::words(strip_tags($event['desc']), 20)}}}" class="btn btn-just-icon btn-round btn-white btn-twitter social-share">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                    @endif
                                    @if($event['social_show_linkedin'] === 1)
                                        <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{$event['event_url']}}?title={{urlencode($event['title'])}}&amp;summary={{{Str::words(strip_tags($event['desc']), 20)}}}" class="btn btn-just-icon btn-round btn-white btn-linkedin social-share">
                                            <i class="fa fa-linkedin"></i>
                                        </a>
                                    @endif
                                    @if($event['social_show_googleplus'] === 1)
                                        <a href="https://plus.google.com/share?url={{$event['event_url']}}" class="btn btn-just-icon btn-round btn-white btn-google social-share">
                                            <i class="fa fa-google-plus"></i>
                                        </a>
                                    @endif
                                    @if($event['social_show_facebook'] === 1)
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{$event['event_url']}}" class="btn btn-just-icon btn-round btn-white btn-facebook social-share">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-content">

                    <h4 class="card-title">
                        <a href="{{ $event['event_url'] }}">{{ $event['title'] }}</a>
                    </h4>

                    @if(Auth::guard('client')->user())
                        <a href="{{ route('showCategory', $event['category']['id']) }}">
                            <h6 class="category category-popover-{{ $event['category']['id'] }} text-info"
                                data-html="true" data-toggle="popover" data-placement="auto bottom"
                                data-content="<div class='category-popover'>
                                <img class='img-thumbnail category-thumb' src='{{ $event['category']['image'] }}'>
                                <br> <span class='text-info'><strong>{{ $event['category']['name'] }}</strong></span> <br>

                                <i class='material-icons btn-fav-category {{ in_array($event['category']['id'], $favorites) ? 'vt-red': 'vt-grey' }} '
                                data-fans-route='{{ route('fans', $event['category']['id']) }}'
                                data-favorite-route='{{ route('favorite', $event['category']['id']) }}'
                                data-unfavorite-route='{{ route('unfavorite', $event['category']['id']) }}'
                                data-category-events='{{ $event['category']['events'] }}'
                                data-category-name='{{ $event['category']['name'] }}'
                                data-category-thumb='{{ $event['category']['image'] }}'
                                data-category-id='{{ $event['category']['id'] }}'>favorite</i>
                                <br>
                                <div class='fav-counter vt-grey'>
                                <i class='material-icons' title='#fans'>favorite</i> <span title='#fans' class='fans-counter-{{ $event['category']['id'] }}'> {{ count($event['category']['fans_ids']) }} </span> &nbsp; &middot; &nbsp;
                                <i class='material-icons' title='#active events'>list</i> <span title='#active events'> {{ $event['category']['events'] }}</span>
                                </div></div>">

                                {{ $event['category']['name'] }}
                            </h6>
                        </a>

                    @else
                        <a href="{{ route('showCategory', $event['category']['id']) }}">
                            <h6 class="category text-info"
                                data-html="true" data-toggle="popover" data-placement="auto bottom"
                                data-content="<div class='category-popover'>
                                <img class='img-thumbnail category-thumb' src='{{ $event['category']['image'] }}'>
                                <br> <span class='text-info'><strong>{{ $event['category']['name'] }}</strong></span> <br>

                                <div class='fav-counter vt-grey'>
                                <i class='material-icons' title='#fans'>favorite</i> <span title='#fans'> {{ count($event['category']['fans_ids']) }} </span> &nbsp; &middot; &nbsp;
                                <i class='material-icons' title='#active events'>list</i> <span title='#active events'> {{ $event['category']['events'] }}</span>
                                </div></div>">

                                {{ $event['category']['name'] }}
                            </h6>
                        </a>
                    @endif
                    <p class="card-description">
                        {{ str_limit($event['desc'], $limit = 200, $end = '...') }}
                    </p>
                    <div class="footer">
                        <div class="author">
                            @if(Auth::guard('client')->user())
                            <a class="organiser-name organiser-popover-{{ $event['organiser']['id'] }}" href="{{ route('showOrganiserHome', [$event['organiser']['id'], Str::slug($event['organiser']['name'])]) }}"
                               data-html="true" data-toggle="popover" data-placement="auto"
                               data-content="<div class='organiser-popover-content'>
                                <img class='img-thumbnail category-thumb' src='{{ $event['organiser']['image_path']['60*60'] }}'>
                                <br> <span class='text-info'><strong>{{ $event['organiser']['name'] }}</strong></span> <br>
                                <i title='follow' class='material-icons btn-follow-organiser {{ in_array($event['organiser']['id'], $following) ? 'vt-red': 'vt-grey' }} '
                                data-follow-route='{{ route('follow', $event['organiser']['id']) }}'
                                data-unfollow-route='{{ route('unfollow', $event['organiser']['id']) }}'
                                data-followers-route='{{ route('followers', $event['organiser']['id']) }}'
                                data-organiser-events='{{ $event['organiser']['events'] }}'
                                data-organiser-name='{{ $event['organiser']['name'] }}'
                                data-organiser-thumb='{{ $event['organiser']['image_path']['60*60'] }}'
                                data-organiser-id='{{ $event['organiser']['id'] }}'>star</i>

                                <br>
                                <div class='fav-counter vt-grey'>
                                <i class='material-icons' title='#fans'>star</i> <span title='#fans' class='followers-counter-{{ $event['organiser']['id'] }}'> {{ count($event['organiser']['followers_ids']) }} </span> &nbsp; &middot; &nbsp;
                                <i class='material-icons' title='#active events'>list</i> <span title='#active events'> {{ $event['organiser']['events'] }}</span>
                                </div></div>">
                                <img src="{{ $event['organiser']['image_path']['original'] }}" alt="organiser logo" class="avatar img-raised">
                                <span>{{ $event['organiser']['name'] }}</span>
                            </a>
                            @else
                            <a class="organiser-name organiser-popover-{{ $event['organiser']['id'] }}" href="{{ route('showOrganiserHome', [$event['organiser']['id'], Str::slug($event['organiser']['name'])]) }}"
                               data-html="true" data-toggle="popover" data-placement="auto"
                               data-content="<div class='organiser-popover-content'>
                                <img class='img-thumbnail category-thumb' src='{{ $event['organiser']['image_path']['original'] }}'>
                                <br> <span class='text-info'><strong>{{ $event['organiser']['name'] }}</strong></span> <br>

                                <div class='fav-counter vt-grey'>
                                <i class='material-icons' title='#fans'>star</i> <span title='#fans'> {{ count($event['organiser']['followers_ids']) }} </span> &nbsp; &middot; &nbsp;
                                <i class='material-icons' title='#active events'>list</i> <span title='#active events'> {{ $event['organiser']['events'] }}</span>
                                </div></div>">
                                <img src="{{ $event['organiser']['image_path']['60*60'] }}" alt="organiser logo" class="avatar img-raised">
                                <span>{{ $event['organiser']['name'] }}</span>
                            </a>
                            @endif
                        </div>
                        @if(Auth::guard('client')->user())
                        <div class="stats">
                            <a class="event-like-status {{ in_array($event['id'], $liked_events) ? 'vt-red': 'vt-grey' }}"
                               data-like-route="{{ route('like', $event['id']) }}"
                               data-unlike-route="{{ route('unlike', $event['id']) }}"
                               data-likes-route="{{ route('likes', $event['id']) }}"
                               data-event-id="{{ $event['id'] }}">
                                <i title='like' class="material-icons">thumb_up</i>
                            </a> <span id="likes-counter-{{$event['id']}}">{{ $event['likes_counter'] }}</span>
                        </div>
                        @else
                        <div class="stats">
                            <i class="material-icons fav">thumb_up</i> <span>{{ $event['likes_counter'] }}</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <div class="navigation">
            <div class="nav-next">
                <a href="{{ $events['next_page_url'] }}"></a>
            </div>
        </div>

    @endif
