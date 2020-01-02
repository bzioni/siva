<?php // Template Name: Contact page
get_header();
?>


<main class="container py-3 py-lg-4">

    <div class="entry-content text-center mb-3">
		<?php the_content() ?>
    </div>

    <div class="row justify-content-center">

        <div class="col-md-3 mb-3 mb-lg-0 text-center">
            <div class="d-flex flex-column align-items-center py-3">
                <span class="icon icon-mail  icon-l mb-2 d-block text-color-3"></span>
                <span class="h5  mb-0"><?php the_field( '_sogo_contact_email_text' ) ?></span>
                <a href="mailto:<?php the_field( '_sogo_contact_email' ) ?>"
                   class="h5 text-color-1"><?php the_field( '_sogo_contact_email' ) ?></a>
            </div>
        </div>

        <div class="col-md-3 mb-3 mb-lg-0 text-center">
            <div class="d-flex flex-column align-items-center py-3">
                <span class="icon icon-phone  icon-l mb-2 d-block text-color-3"></span>
                <span class="h5  mb-0"><?php the_field( '_sogo_contact_phone_text' ) ?></span>
                <a href="tel:<?php the_field( '_sogo_contact_phone' ) ?>"
                   class="h5 text-color-1"><?php the_field( '_sogo_contact_phone_display' ) ?></a>
            </div>
        </div>


        <div class="col-md-3 mb-3 mb-lg-0 text-center">
            <div class="d-flex flex-column align-items-center py-3">
                <span class="icon icon-address  icon-l mb-2 d-block text-color-3"></span>
                <span class="h5  mb-0"><?php the_field( '_sogo_contact_address_text' ) ?></span>
                <a href="<?php the_field( '_sogo_contact_address_url' ) ?>"
                   class="h5 text-color-1"><?php the_field( '_sogo_contact_address' ) ?></a>
            </div>
        </div>

    </div>

    <span class="d-block h3 text-center"><?php the_field( '_sogo_contact_form_title' ) ?></span>
	<?php echo do_shortcode( '[contact-form-7 id="' . get_field( '_sogo_contact_form' ) . '"]' ); ?>


</main>
<script>
    (function ($) {
        'use strict';
        $(document).ready(function () {
            var $form = $('.wpcf7');
            if ($form.length) {
                if (sogoc.locale !== 'he') {
                    $form.attr('dir', 'ltr')
                }
            }
        });
    })(jQuery);
</script>
<?php get_footer() ?>


