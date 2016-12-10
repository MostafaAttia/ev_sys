@extends('Shared.Layouts.Master')

@section('title')
    @parent
    Dashboard
@stop

@section('top_nav')
    @include('ManageOrganiser.Partials.TopNav')
@stop
@section('page_title')
    {{ $organiser->name }} Dashboard
@stop

@section('menu')
    @include('ManageOrganiser.Partials.Sidebar')
@stop

@section('head')

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    {!! HTML::script('https://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places') !!}
    {!! HTML::script('vendor/geocomplete/jquery.geocomplete.min.js')!!}
    {!! HTML::script('vendor/moment/moment.js')!!}
    {!! HTML::script('vendor/moment-timezone/builds/moment-timezone-with-data.min.js')!!}
    {!! HTML::script('vendor/fullcalendar/dist/fullcalendar.min.js')!!}
    {!! HTML::style('vendor/fullcalendar/dist/fullcalendar.css')!!}

    <script>
        moment.tz.guess();
        $(function() {

            var calendar_activities = JSON.parse(' {!! $calendar_activities !!} ');
            var calendar_events = JSON.parse(' {!! $calendar_events !!} ');
            var repeatingEvents = [];
            for (var i = 0, len = calendar_activities.length; i < len; i++) {
                repeatingEvents.push({
                    "title" : calendar_activities[i].title,
                    "start" : calendar_activities[i].start,
                    "end"   : calendar_activities[i].end,
                    "dow"   : calendar_activities[i].dow,
                    "ranges": [{
                        "start": moment(calendar_activities[i].ranges.start),
                        "end"  : moment(calendar_activities[i].ranges.end)
                    }],
                    "url"   : calendar_activities[i].url,
                    "color" : calendar_activities[i].color

                });
            }
            for (var i = 0, len = calendar_events.length; i < len; i++) {
                repeatingEvents.push({
                    "title" : calendar_events[i].title,
                    "start" : calendar_events[i].start,
                    "end"   : calendar_events[i].end,
                    "url"   : calendar_events[i].url,
                    "color" : calendar_events[i].color
                });
            }
            var getEvents = function( start, end ){
                return repeatingEvents;
            };

            $('#calendar').fullCalendar({
                defaultDate: moment(),
                header: {
                    left: 'prev, today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay, next'
                },
                defaultView: 'month',
                eventRender: function(event, element, view){
                    if("ranges" in event){
                        return (event.ranges.filter(function(range){
                            return (event.start.isBefore(range.end) &&
                            event.end.isAfter(range.start));
                        }).length)>0;
                    }

                    return true;

                },
                events: function( start, end, timezone, callback ){
                    var events = getEvents(start,end);

                    callback(events);
                }
            });

        });
    </script>
@stop

@section('content')
    <div class="row">
        <div class="col-sm-4">
            <div class="stat-box">
                <h3>
                    {{$organiser->events->count()}}
                </h3>
            <span>
                Events
            </span>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="stat-box">
                <h3>
                    {{$organiser->attendees->count()}}
                </h3>
            <span>
                Tickets Sold
            </span>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="stat-box">
                <h3>
                    {{ money($organiser->events->sum('sales_volume') + $organiser->events->sum('organiser_fees_volume'), $organiser->account->currency) }}
                </h3>
            <span>
                Sales Volume
            </span>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-8">

            <h4 style="margin-bottom: 25px;margin-top: 20px;">Event Calendar</h4>

            <div>
                <span style="font-size:12px; padding-left:12px; background:#4E558F;">&nbsp;</span> Event <br>
                <span style="font-size:12px; padding-left:12px; background:#0F8000;">&nbsp;</span> Activity <br> <br>
            </div>

            <div id="calendar"></div>


            <h4 style="margin-bottom: 25px;margin-top: 20px;">Upcoming Events</h4>
            @if($upcoming_events->count())
                @foreach($upcoming_events as $event)
                    @include('ManageOrganiser.Partials.EventPanel')
                @endforeach
            @else
                <div class="alert alert-success alert-lg">
                    You have no events coming up. <a href="#"
                                                     data-href="{{route('showCreateEvent', ['organiser_id' => $organiser->id])}}"
                                                     class=" loadModal">You can click here to create an event.</a>
                </div>
            @endif
        </div>
        <div class="col-md-4">
            <h4 style="margin-bottom: 25px;margin-top: 20px;">Recent Orders</h4>
              @if($organiser->orders->count())
            <ul class="list-group">
                    @foreach($organiser->orders()->orderBy('created_at', 'desc')->take(5)->get() as $order)
                        <li class="list-group-item">
                            <h6 class="ellipsis">
                                <a href="{{ route('showEventDashboard', ['event_id' => $order->event->id]) }}">
                                    {{ $order->event->title }}
                                </a>
                            </h6>
                            <p class="list-group-text">
                                <a href="{{ route('showEventOrders', ['event_id' => $order->event_id, 'q' => $order->order_reference]) }}">
                                    <b>#{{ $order->order_reference }}</b></a> -
                                <a href="{{ route('showEventAttendees', ['event_id'=>$order->event->id,'q'=>$order->order_reference]) }}">{{ $order->full_name }}</a>
                                registered {{ $order->attendees()->withTrashed()->count() }} ticket{{ $order->attendees()->withTrashed()->count()  > 1 ? 's' : '' }}.
                            </p>
                            <h6>
                                {{ $order->created_at->diffForHumans() }} &bull; <span
                                        style="color: green;">{{ $order->event->currency_symbol }}{{ $order->amount }}</span>
                            </h6>
                        </li>
                    @endforeach
                  @else
                            <div class="alert alert-success alert-lg">
                                Looks like there are no recent orders.
                            </div>
                @endif
            </ul>

        </div>
    </div>
@stop
