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

materialKit.initFormExtendedDatetimepickers();

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

$('#masonry-grid').masonry({
    columnWidth: '.grid-sizer',
    itemSelector: '.grid-item'
//            percentPosition: true
});

$(function () {
    $('#dobpicker').datetimepicker({
        viewMode: 'years'
    });
});
