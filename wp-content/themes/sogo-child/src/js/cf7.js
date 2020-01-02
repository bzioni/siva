(function ($) {
    "use strict";

    $(document).ready(function () {

        var $wpcf7 = $('.wpcf7');
        $wpcf7.on('submit', function (e) {
            $(this).closest('.wpcf7').addClass('cf7-sending');
        });

        $wpcf7.on('invalid.wpcf7', function (e) {
            $(this).closest('.wpcf7').removeClass('cf7-sending');
        });

        document.addEventListener('wpcf7mailsent', function (event) {
            location = sogoc.thank_you_page;
        }, false);

    });


})(jQuery);

