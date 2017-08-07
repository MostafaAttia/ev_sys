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

});

