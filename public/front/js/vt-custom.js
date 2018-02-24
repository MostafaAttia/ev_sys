$(document).ready(function(){
    $('.page-header').vegas({
        slides: [
            { src: 'front/img/slider.jpg',
                video: {
                    src: [
                        'front/img/video/vitee.mp4'
                    ],
                    loop: true,
                    mute: true
                }
            }
        ]
    });

    $(document).on('click','.event-like-status', function(event){
        event.preventDefault();
        var event_id = $(this).attr('data-event-id');

        if($(this).hasClass('vt-grey')) {
            $.get('client/like/' + event_id).then(
                function() {
                    $.get('client/likes/' + event_id, function(data){
                        $('#likes-counter-'+event_id).text(data);
                    });
                });
            $(this).removeClass('vt-grey').addClass('vt-red');
        } else {
            $.get('client/unlike/' + event_id).then(
                function() {
                    $.get('client/likes/' + event_id, function(data){
                        $('#likes-counter-'+event_id).text(data);
                    });
                });;
            $(this).removeClass('vt-red').addClass('vt-grey');
        }
    });


    $(document).on('click','.btn-fav-category', function(event){
        event.preventDefault();
        var category_id = $(this).attr('data-category-id');
        var category_name = $(this).attr('data-category-name');
        var category_events = $(this).attr('data-category-events');
        var category_thumb = $(this).attr('data-category-thumb');

        if($(this).hasClass('vt-grey')) {
            $.get('client/favorite/' + category_id).then(
                function() {
                    $.get('client/fans/' + category_id).then( function(data){
                        var popover = $('.category-popover-'+category_id).data('bs.popover');
                        var data_content = " <div class='category-popover'>"
                            +"<img class='img-thumbnail category-thumb' src='" +category_thumb+ "'> "
                            +"<br> <span class='text-info'><strong>" + category_name + "</strong></span> <br>"
                            +"<i class='material-icons vt-red btn-fav-category' data-category-thumb='"+category_thumb+"' data-category-name='"+category_name+"' data-category-events='"+category_events+"' data-category-id='" + category_id + "'>favorite</i> <br> "
                            +"<div class='fav-counter vt-grey'>"
                            +"<i class='material-icons'>favorite</i> <span title='#fans' class='fans-counter-"+ category_id + "'> " +data+ "</span> &nbsp; &middot; &nbsp;"
                            +"<i class='material-icons'>list</i> <span title='#active events'> " + category_events + "</span>"
                            +"</div></div> ";
                        $('.category-popover-'+category_id).attr('data-content', data_content);
                        $('.fans-counter-'+category_id).text(data);
                    });

                });
            $(this).removeClass('vt-grey').addClass('vt-red');
        } else {
            $.get('client/unfavorite/' + category_id).then(
                function() {
                    $.get('client/fans/' + category_id).then( function(data){
                        var popover = $('.category-popover-'+category_id).data('bs.popover');
                        var data_content = " <div class='category-popover'>"
                            +"<img class='img-thumbnail category-thumb' src='" +category_thumb+ "'> "
                            +"<br> <span class='text-info'><strong>" + category_name + "</strong></span> <br>"
                            +"<i class='material-icons vt-grey btn-fav-category' data-category-thumb='"+category_thumb+"' data-category-name='"+category_name+"' data-category-events='"+category_events+"' data-category-id='" + category_id + "'>favorite</i> <br> "
                            +"<div class='fav-counter vt-grey'>"
                            +"<i class='material-icons'>favorite</i> <span title='#fans' class='fans-counter-"+ category_id + "'> " +data+ "</span> &nbsp; &middot; &nbsp;"
                            +"<i class='material-icons'>list</i> <span title='#active events'> " + category_events + "</span>"
                            +"</div></div> ";
                        $('.category-popover-'+category_id).attr('data-content', data_content);
                        $('.fans-counter-'+category_id).text(data);
                    });
                });
            $(this).removeClass('vt-red').addClass('vt-grey');
        }
    });

    // Follow Organiser
    $(document).on('click','.btn-follow-organiser', function(event){
        event.preventDefault();
        var organiser_id = $(this).attr('data-organiser-id');
        var organiser_name = $(this).attr('data-organiser-name');
        var organiser_events = $(this).attr('data-organiser-events');
        var organiser_thumb = $(this).attr('data-organiser-thumb');

        if($(this).hasClass('vt-grey')) {
            $.get('client/follow/' + organiser_id).then(
                function() {
                    $.get('client/followers/' + organiser_id).then( function(data){
                        //var popover = $('.organiser-popover-'+organiser_id).data('bs.popover');
                        var data_content = " <div class='organiser-popover-content'>"
                            +"<img class='img-thumbnail category-thumb' src='" +organiser_thumb+ "'> "
                            +"<br> <span class='text-info'><strong>" + organiser_name + "</strong></span> <br>"
                            +"<i class='material-icons vt-red btn-follow-organiser' data-organiser-thumb='"+organiser_thumb+"' data-organiser-name='"+organiser_name+"' data-organiser-events='"+organiser_events+"' data-organiser-id='" + organiser_id + "'>star</i> <br> "
                            +"<div class='fav-counter vt-grey'>"
                            +"<i class='material-icons'>star</i> <span title='#fans' class='followers-counter-"+ organiser_id + "'> " +data+ "</span> &nbsp; &middot; &nbsp;"
                            +"<i class='material-icons'>list</i> <span title='#active events'> " + organiser_events + "</span>"
                            +"</div></div> ";
                        $('.organiser-popover-'+organiser_id).attr('data-content', data_content);
                        $('.followers-counter-'+organiser_id).text(data);
                    });

                });
            $(this).removeClass('vt-grey').addClass('vt-red');
        } else {
            $.get('client/unfollow/' + organiser_id).then(
                function() {
                    $.get('client/followers/' + organiser_id).then( function(data){
                        //var popover = $('.organiser-popover-'+organiser_id).data('bs.popover');
                        var data_content = " <div class='organiser-popover-content'>"
                            +"<img class='img-thumbnail category-thumb' src='" +organiser_thumb+ "'> "
                            +"<br> <span class='text-info'><strong>" + organiser_name + "</strong></span> <br>"
                            +"<i class='material-icons vt-grey btn-follow-organiser' data-organiser-thumb='"+organiser_thumb+"' data-organiser-name='"+organiser_name+"' data-organiser-events='"+organiser_events+"' data-organiser-id='" + organiser_id + "'>star</i> <br> "
                            +"<div class='fav-counter vt-grey'>"
                            +"<i class='material-icons'>star</i> <span title='#fans' class='followers-counter-"+ organiser_id + "'> " +data+ "</span> &nbsp; &middot; &nbsp;"
                            +"<i class='material-icons'>list</i> <span title='#active events'> " + organiser_events + "</span>"
                            +"</div></div> ";
                        $('.organiser-popover-'+organiser_id).attr('data-content', data_content);
                        $('.followers-counter-'+organiser_id).text(data);
                    });
                });
            $(this).removeClass('vt-red').addClass('vt-grey');
        }
    });



    $(document).ajaxComplete(function() {

        $(".category").popover({ trigger: "manual" , html: true, animation:false})
            .on("mouseenter", function () {
                var _this = this;
                $(this).popover("show");
                $(".popover").on("mouseleave", function () {
                    $(_this).popover('hide');
                });
            }).on("mouseleave", function () {
                var _this = this;
                setTimeout(function () {
                    if (!$(".popover:hover").length) {
                        $(_this).popover("hide");
                    }
                }, 300);
            });

        $(".organiser-name").popover({ trigger: "manual" , html: true, animation:false})
            .on("mouseenter", function () {
                var _this = this;
                $(this).popover("show");
                $(".popover").on("mouseleave", function () {
                    $(_this).popover('hide');
                });
            }).on("mouseleave", function () {
                var _this = this;
                setTimeout(function () {
                    if (!$(".popover:hover").length) {
                        $(_this).popover("hide");
                    }
                }, 300);
            });

    });


    $('.nav-pills-icons li').click(function(event){
        event.preventDefault();
        $('.active').removeClass('active');
        $(this).addClass('active');
    });

    //$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

    var $container = $('#masonry-grid');
    var next_url = $('.nav-next a');

    if(next_url.attr('href') == '') {
        $('#loading-spin').hide();
    }

    function onGetClick(route)
    {
        $.get(route, onSuccess);
    }

    function onSuccess(data)
    {
        var responseAsHTML = $.parseHTML( data );
        next_url = $(responseAsHTML).find(".nav-next a");
        $container.infinitescroll('destroy');
        $container.infinitescroll('binding','unbind');
        $container.data('infinitescroll', null);
        $container.html(responseAsHTML);

        if(next_url.attr('href') == '') {
            $('#loading-spin').hide();
        }

        if($('#noCategoryEvents').length){
            $container.css('height', '400px');
            $('#loading-spin').hide();
            return false;
        } else {
            initMasonry();
            $container.masonry('reloadItems');
            RotateCardReset();
        }
    }

    $('.events-filter').on('click', function(event){
        event.preventDefault();
        onGetClick($(this).attr('data-cat-route'));
    });

    var initMasonry = function() {
        $container.imagesLoaded().progress(function(){
            $('#masonry-grid').masonry({
                itemSelector: '.grid-item',
                columnWidth: '.grid-sizer',
                percentPosition: true
            });
        });
        $container.infinitescroll({
                navSelector  : ".navigation",
                nextSelector : next_url,
                itemSelector : ".grid-item",
                loading: {
                    finishedMsg: '<span class="no-more-events"> No more events at the moment, <strong>Stay Tuned!</strong>  </span>',
                    msgText: "<em>Loading...</em>"
                },
                errorCallback: function() { $('#infscr-loading').animate({opacity: 0.8}, 15000).fadeOut('slow'); }
            },
            function( newElements ) {
                // hide new items while they are loading
                var $newElems = $( newElements ).hide();
                $('#loading-spin').show();
                // ensure that images load before adding to masonry layout
                $newElems.imagesLoaded(function(){
                    $('#loading-spin').hide();
                    // show elems now they're ready
                    $newElems.show();
                    RotateCardReset();  // Reset Rotating Cards
                    $('#masonry-grid').masonry( 'appended', $newElems, true );
                });
            });
    };
    initMasonry();

    var popupSize = {
        width: 780,
        height: 550
    };

    $('.social-share').on('click', function(e){

        var verticalPos = Math.floor(($(window).width() - popupSize.width) / 2),
            horizontalPos = Math.floor(($(window).height() - popupSize.height) / 2);

        var popup = window.open($(this).prop('href'), 'social',
            'width='+popupSize.width+',height='+popupSize.height+
            ',left='+verticalPos+',top='+horizontalPos+
            ',location=0,menubar=0,toolbar=0,status=0,scrollbars=0,resizable=0');

        if (popup) {
            e.preventDefault();
            popup.focus();
        }

    });





});

