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
    $(document).on('click','.favorite_category', function(event){
        event.preventDefault();
        var favoriteRoute = $(this).attr('data-favorite-route');
        var unfavoriteRoute = $(this).attr('data-unfavorite-route');

        if($(this).hasClass('btn-default')) {
            $.get(favoriteRoute);
            $(this).removeClass('btn-default').addClass('btn-primary');
            $(this).attr('data-original-title','Unfavorite');
        } else {
            $.get(unfavoriteRoute);
            $(this).removeClass('btn-primary').addClass('btn-default');
            $(this).attr('data-original-title','Favorite');
        }
    });
});