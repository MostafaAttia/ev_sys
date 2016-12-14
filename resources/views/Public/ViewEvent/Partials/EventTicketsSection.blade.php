<section id="tickets" class="container">
    <div class="row">
        <h1 class='section_head'>
            Tickets
        </h1>
    </div>

    @if($event->is_activity)

        @if($event->end_date->isPast())
            <div class="alert alert-boring">
                This activity has ended.
            </div>
        @else
            @include('Public.ViewEvent.Partials.EventTickets')
        @endif

    @else

        @if($event->start_date->isPast())
            <div class="alert alert-boring">
                This event has {{($event->end_date->isFuture() ? 'already started' : 'ended')}}.
            </div>
        @else
            @include('Public.ViewEvent.Partials.EventTickets')
        @endif

    @endif

</section>