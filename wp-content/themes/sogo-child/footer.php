<?php include 'templates/component-scrolltop.php' ?>
    <?php include 'templates/component-cta.php' ?>

<footer class="bg-white border-top-1 border-color-3">
    <div class="container">

        <div class="row py-3">
            <div class="col-md-3 py-2 mb-2 mb-md-0">
				<?php dynamic_sidebar( 'footer-col-1' ) ?>
				<?php
				$phone = get_field( '_sogo_header_phone', 'option' );
				if ( $phone['dial'] ): ?>

                    <a class="text-color-1 d-flex justify-content-center justify-content-lg-start align-items-center mt-2"
                       href="tel:<?php echo $phone['dial'] ?>">
                        <span class="h6 mb-0 white-space-nowrap hover-color-3 transition"><?php echo $phone['display'] ?></span>
                        <span class="icon-mobile icon-s text-color-1"></span>
                    </a>
				<?php endif; ?>
            </div>

            <div class="col-md-3 mb-2 mb-md-0">
				<?php dynamic_sidebar( 'footer-col-2' ) ?>
            </div>

            <div class="col-md-3 mb-2 mb-md-0">
				<?php dynamic_sidebar( 'footer-col-3' ) ?>
            </div>

            <div class="col-md-3 mb-2 mb-md-0">
				<?php dynamic_sidebar( 'footer-col-4' ) ?>
            </div>
        </div>
    </div>
    <div style="background-color:#fafafa">
        <div class="container d-flex flex-column flex-lg-row justify-content-lg-between py-2 text-center">
            <span class="text-color-1"><?php echo get_field( '_sogo_footer_copy', 'option' ) . ' ' . date( 'Y' ) ?></span>
            <a href="https://sogo.co.il/" target="_blank" title="SOGO DIGITAL Website" class="d-flex align-items-center justify-content-center">
                <span class="text-bread-crumbs text-color-1">Sogo Digital UI & UX Development</span>
                <img class="mr-2" width="40" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/sogo_logo.svg' ?>" alt="">
            </a>
        </div>
    </div>
</footer>

<script>
    (function ($) {
        'use strict';
        $(document).ready(function () {
            /*
            * FOOTER MENU
             */
            var $window = $(window);

            $('.js-open-footer-menu').on('click', function () {
                $(this).parent().toggleClass('is-active');
            });
            $window.on('resize', function () {
                if ($window.width() > mobile_width) {
                    $('div[class^="menu-footer-"]').each(function () {
                        var $this = $(this)
                        if ($this.is(":hidden")) {
                            $this.removeAttr("style");
                        }
                    })
                }
            });
        });
    })(jQuery);
</script>


<?php wp_footer(); ?>
</body>
</html>
