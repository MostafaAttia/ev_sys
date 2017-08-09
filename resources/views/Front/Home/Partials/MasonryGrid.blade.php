    @if(count($events['data']) === 0)

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div id="noCategoryEvents" class="text-center">
                <div class="card card-plain card-blog">
                    <div class="card-image">
                        <img class="img img-raised" src="../front/img/NoCategoryEvents.png" />
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
                    <h6 class="category text-info">{{ $event['category']['name'] }}</h6>
                    <h4 class="card-title">
                        <a href="{{ route('showEventPage', $event['id']) }}">{{ $event['title'] }}</a>
                    </h4>
                    <p class="card-description">
                        {{ str_limit($event['desc'], $limit = 200, $end = '...') }}
                    </p>
                    <div class="footer">
                        <div class="author">
                            <a href="{{route('showOrganiserHome', [$event['organiser']['id'], Str::slug($event['organiser']['name'])])}}" title="Organiser Page">
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

        <div class="navigation">
            <div class="nav-next">
                <a href="{{ $events['next_page_url'] }}"></a>
            </div>
        </div>

    @endif
