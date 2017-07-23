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


    (function() {

        var $container = $('#masonry-grid');

        // Masonry + ImagesLoaded
        $container.imagesLoaded().progress(function(){
            $container.masonry({
                itemSelector: '.grid-item',
                columnWidth: '.grid-sizer'
            });
        });

        // Infinite Scroll
        $container.infinitescroll({
                // selector for the paged navigation (it will be hidden)
                navSelector  : ".navigation",
                // selector for the NEXT link (to page 2)
                nextSelector : ".nav-next a",
                // selector for all items you'll retrieve
                itemSelector : ".grid-item",

                // finished message
                loading: {
                    finishedMsg: '<span class="no-more-events"> No more events at the moment, <strong>Stay Tuned!</strong>  </span>',
                    img: 'http://i.imgur.com/6RMhx.gif',
                    msgText: "<em>Loading...</em>"
                },
                errorCallback: function() { $('#infscr-loading').animate({opacity: 0.8}, 15000).fadeOut('slow'); }
            },

            // Trigger Masonry as a callback
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
                    $container.masonry( 'appended', $newElems, true );
                });
            });

    })();


});
