<button id="js-scrollToTop" style="padding:1rem" class="back-to-top bg-white border-2 border-color-3 rounded-circle hide position-fixed pos-b-3 pos-r-3 z-index-2">
    <span class="icon-arrowup xy-align icon-xs text-color-3"></span>
</button>


<script>
    (function ($) {
        'use strict';
        $(document).ready(function () {
            var $window = $(window);

            var $js_scroll = $('#js-scrollToTop');
            $window.scroll(function () {
                if ($(this).scrollTop() > 50) {
                    $js_scroll.removeClass('hide');
                } else {
                    $js_scroll.addClass('hide');
                }
            });

            $js_scroll.on('click', function (e) {
                $('html, body').animate({
                    scrollTop: 0
                }, 500);

                e.preventDefault();
            });
        });
    })(jQuery);
</script>
