@if(!$event->is_live)
<section id="goLiveBar">
    <div class="container">
                @if(!$event->is_live)
                This event is not visible to the public - <a style="background-color: green; border-color: green;" class="btn btn-success btn-xs" href="{{route('MakeEventLive' , ['event_id' => $event->id])}}" >Publish Event</a>
                @endif
    </div>
</section>
@endif
<section id="organiserHead" class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div onclick="window.location='#organiser'" class="event_organizer">
                    <b>{{$event->organiser->name}}</b> Presents
                </div>
            </div>
        </div>
    </div>
</section>
<section id="intro" class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-plain card-blog">
                @if($event->images->first()['image_path'])
                    <div class="card-image">
                        <img class="img img-raised vt-event-image" src="{{config('attendize.s3_base_url').config('attendize.s3_event_images_original').$event->images->first()['image_path']}}">
                    </div>
                @endif

                <div class="card-content">
                    @if($event->images->first()['image_path'])
                    <h6 class="category text-info">{{ $event->category->name }}</h6>
                    @endif
                    <h1 class="card-title" style="color: #fff;">{{ $event->title }}</h1>
                </div>
            </div>
            <div class="event_venue">
                @if($event->is_activity)
                    <b>From: </b>
                    <span property="startDate" content="{{ $event->start_date->toIso8601String() }}">
                        {{ $event->start_date->format('D d M Y') }}
                    </span>
                @else
                    <span property="startDate" content="{{ $event->start_date->toIso8601String() }}">
                        {{ $event->start_date->format('D d M H:i A') }}
                    </span>
                @endif

                @if($event->is_activity)
                    <b>To: </b>
                    <span property="endDate" content="{{ $event->end_date->toIso8601String() }}">
                             @if($event->start_date->diffInHours($event->end_date) <= 12)
                                {{ $event->end_date->format('H:i A') }}
                             @else
                                {{ $event->end_date->format('D d M Y') }}
                             @endif
                    </span>
                    <br>
                    <b>Every: </b>
                    <span>
                        @foreach($event->weekdays_names as $day)
                            {{ $day->name }},
                        @endforeach
                    </span>
                    <br>
                    <span>
                        {{ \Carbon::parse($event->activity_start_time)->format('H:i')  }} &nbsp;
                        <i class="fa fa-clock-o"></i> &nbsp;
                        {{ \Carbon::parse($event->activity_end_time)->format('H:i')  }}
                    </span>
                    <br>
                @else
                    <span property="endDate" content="{{ $event->end_date->toIso8601String() }}">
                         @if($event->start_date->diffInHours($event->end_date) <= 12)
                            {{ $event->end_date->format('H:i A') }}
                        @else
                            {{ $event->end_date->format('D d M H:i A') }}
                        @endif
                    </span>
                @endif
                @
                <span property="location" typeof="Place">
                    <b property="name">{{$event->venue_name}}</b>
                    <meta property="address" content="{{ urldecode($event->venue_name) }}">
                </span>
            </div>

            <div class="event_buttons">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <a class="btn btn-event-link btn-lg" href="#tickets">TICKETS</a>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <a class="btn btn-event-link btn-lg" href="#details">DETAILS</a>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <a class="btn btn-event-link btn-lg" href="#location">LOCATION</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
