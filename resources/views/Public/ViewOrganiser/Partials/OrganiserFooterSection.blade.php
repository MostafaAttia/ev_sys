<footer id="footer" class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('Shared.Partials.PoweredBy')
                @if(Utils::userOwns($organiser))
                    &bull;
                    <a class="adminLink"
                       href="{{route('showOrganiserDashboard' , ['organiser_id' => $organiser->id])}}">Organiser
                        Dashboard</a>
                @endif
            </div>
        </div>
    </div>
</footer>
