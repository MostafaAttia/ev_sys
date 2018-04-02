<section id="intro" class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="organiser_logo">
                <div class="thumbnail">
                    <img src="{{$organiser->full_logo_path}}" />
                </div>
            </div>
            <h1>{{$organiser->name}}</h1>
            @if(Auth::guard('client')->user())
                <button data-follow-route="{{ route('follow', $organiser->id) }}"
                        data-unfollow-route="{{ route('unfollow', $organiser->id) }}"
                        class="btn btn-sm btn-fab follow_organiser {{ in_array($organiser->id, $followings_ids) ? 'btn-primary': 'btn-default'}} " rel="tooltip"
                        title="{{ in_array($organiser->id, $followings_ids) ? 'Unfollow': 'Follow'}}"
                        style="vertical-align: baseline;">
                    <i class="material-icons">star</i>
                </button>
                <script>
                    $(document).ready(function(){
                        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                        $(document).on('click','.follow_organiser', function(event){
                            event.preventDefault();
                            var followRoute = $(this).attr('data-follow-route');
                            var unfollowRoute = $(this).attr('data-unfollow-route');

                            if($(this).hasClass('btn-default')) {
                                $.get(followRoute);
                                $(this).removeClass('btn-default').addClass('btn-primary');
                                $(this).attr('data-original-title','Unfollow this organiser');
                            } else {
                                $.get(unfollowRoute);
                                $(this).removeClass('btn-primary').addClass('btn-default');
                                $(this).attr('data-original-title','Follow this organiser');
                            }
                        });
                    });
                </script>
            @endif
            @if($organiser->about)
            <div class="description pa10">
                {!! $organiser->about !!}
            </div>
            @endif
        </div>
    </div>
</section>
