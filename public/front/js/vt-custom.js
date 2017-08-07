$(document).ready(function(){
    /** Animate Text on Video intro **/
    function dataWord () {
        $("[data-words]").attr("data-words", function(i, d){
            var $self  = $(this),
                $words = d.split("|"),
                tot    = $words.length,
                c      = 0;
            // CREATE SPANS INSIDE SPAN
            for(var i=0; i<tot; i++) $self.append($('<span/>',{text:$words[i]}));
            // COLLECT WORDS AND HIDE
            $words = $self.find("span").hide();
            // ANIMATE AND LOOP
            (function loop(){
                $self.animate({ width: $words.eq( c ).width() });
                $words.stop().fadeOut().eq(c).fadeIn().delay(1000).show(0, loop);
                c = ++c % tot;
            }());
        });
    }
    $(window).on("load", dataWord);

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

    $('.nav-pills-icons li').click(function(event){
        event.preventDefault();
        $('.active').removeClass('active');
        $(this).addClass('active');
    });

    //$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

    var $container = $('#masonry-grid');
    var next_url = $('.nav-next a');

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
                columnWidth: '.grid-sizer'
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




    //var popupSize = {
    //    width: 780,
    //    height: 550
    //};
    //
    //$('.social-share').on('click', function(e){
    //
    //    var
    //        verticalPos = Math.floor(($(window).width() - popupSize.width) / 2),
    //        horisontalPos = Math.floor(($(window).height() - popupSize.height) / 2);
    //
    //    var popup = window.open($(this).prop('href'), 'social',
    //        'width='+popupSize.width+',height='+popupSize.height+
    //        ',left='+verticalPos+',top='+horisontalPos+
    //        ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');
    //
    //    if (popup) {
    //        popup.focus();
    //        e.preventDefault();
    //    }
    //
    //});

    function fbs_click(width, height) {
        var leftPosition, topPosition;
        //Allow for borders.
        leftPosition = (window.screen.width / 2) - ((width / 2) + 10);
        //Allow for title and status bars.
        topPosition = (window.screen.height / 2) - ((height / 2) + 50);
        var windowFeatures = "status=no,height=" + height + ",width=" + width + ",resizable=yes,left=" + leftPosition + ",top=" + topPosition + ",screenX=" + leftPosition + ",screenY=" + topPosition + ",toolbar=no,menubar=no,scrollbars=no,location=no,directories=no";
        u=location.href;
        t=document.title;
        window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer', windowFeatures);
        return false;
    }

    $('.social-share').on('click', function(e){
        return fbs_click(780, 550)
    });









});

