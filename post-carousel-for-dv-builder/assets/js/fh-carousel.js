(function($) {
    $(document).ready(function() {
        $('.et_pb_fh_post_carousels').each(function() {
            var items = $(this).attr('data-items');
            var itemsTablet = $(this).attr('data-items-tablet');
            var itemsPhone = $(this).attr('data-items-phone');
            var loopStatus = $(this).attr('data-loop');
            var margin = $(this).attr('data-margin');
            var autoplay = $(this).attr('data-autoplay') == "on" ? true : false;
            var hoverpause = $(this).attr('data-hoverpause') == "on" ? true : false;
            var mousedrag = $(this).attr('data-mouse-drag') == "on" ? true : false;
            var touchdrag = $(this).attr('data-touch-drag') == "on" ? true : false;
            var autowidth = $(this).attr('data-auto-width') == "on" ? true : false;
            var rewind = $(this).attr('data-rewind') == "on" ? true : false;
            var loop = loopStatus == 'on' ? true : false;
            var slideby = $(this).attr('data-slide-by');
            var dotseach = $(this).attr('data-dots-each') == "on" ? true : false;
            var lazyload = $(this).attr('data-lazy-load') == "on" ? true : false;
            if(typeof itemsTablet == "undefined" || itemsTablet == '') {
                itemsTablet = 2;
            }
            if(typeof itemsPhone == "undefined" || itemsPhone == '') {
                itemsPhone = 1;
            }
            $(this).owlCarousel({
                autoplay: autoplay,
                autoplayHoverPause: hoverpause,
                items: items,
                loop: loop,
                margin: parseInt(margin),
                nav: true,
                dots: true,
                navText: ['',''],
                mouseDrag: mousedrag, 
                touchDrag: touchdrag,
                autoWidth: autowidth,
                rewind: rewind,
                slideBy: slideby,
                dotsEach: dotseach,
                lazyLoad: lazyload,
                responsive : {
                    980: {
                        items: items,
                    },
                    767: {
                        items: itemsTablet,
                        nav: true,
                        dots: true,
                    },
                    0 : {
                        items: itemsPhone,
                    }
                }
            });
        });
    });
})(jQuery);