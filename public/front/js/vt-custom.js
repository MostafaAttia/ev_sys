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

    var popupSize = {
        width: 780,
        height: 550
    };

    $('.social-share').on('click', function(e){

        var
            verticalPos = Math.floor(($(window).width() - popupSize.width) / 2),
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

