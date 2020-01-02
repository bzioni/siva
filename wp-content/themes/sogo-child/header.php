<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php the_field( '_sogo_favicon', 'option' ) ?>"
          type="image/x-icon"/>
    <script>
        var ipad_width = 992;
        var mobile_width = 768;
    </script>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php sogo_print_script( '_sogo_body_scripts' ); ?>
<header id="sticky-header" class="border-bottom-1 border-color-2 w-100 pos-t-0 pos-l-0 z-index-10 d-flex justify-content-center header-shadow">
    <div class="col-12 col-xl-8 mx-auto d-flex  justify-content-between align-items-center py-2 position-relative">

        <button class="hamburger js-hamburger hamburger--spring d-md-none" type="button">
              <span class="hamburger-box">
                <span class="hamburger-inner"></span>
              </span>
        </button>

        <a href="<?php echo site_url( '/' ) . wpm_get_language() ?>">
            <img src="<?php the_field( '_sogo_logo', 'option' ) ?>" alt="">
        </a>

        <nav class="primary-menu">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary_menu',
				'container'      => false,
				'depth'          => 0,
				'walker'         => new SogoHeaderWalker()
			) );
			?>
        </nav>

		<?php
		if ( is_user_logged_in() ) {
			$user_id   = get_current_user_id();
			$user_role = get_user_role( $user_id );
			$sign_url  = get_page_url_by_template_name( 'page-profile.php' ) . '?type=' . $user_role;
			$sign_text = __( 'Edit details', 'sogoc' );
			$sign_icon = 'pencil';
		} else {
			$sign_url  = get_page_url_by_template_name( 'page-signup.php' );
			$sign_text = __( 'Signup / signin', 'sogoc' );
			$sign_icon = 'user';
		}
		?>

        <div class="d-flex justify-content-between align-items-center">
            <a class="header-sign p-1 text-white bg-color-1 d-flex align-items-center <?php echo is_rtl() ? 'flex-row-revese' : '' ?>"
               href="<?php echo $sign_url ?>">
                <span class="icon-<?php echo $sign_icon ?> icon-xs text-white"></span>
                <span class="mx-1 d-none d-md-block"></span>
                <span class="h6 mb-0 transition d-none d-md-block"><?php echo $sign_text ?></span>
            </a>

            <span class="mx-1"></span>


			<?php
			if ( function_exists( 'wpm_language_switcher' ) ):
				$languages = wpm_get_languages();
				$lang = wpm_get_language();
				?>
                <div class="dropdown">
                    <a class="dropdown-toggle d-flex justify-content-between align-items-center <?php echo is_rtl() ? 'flex-row-reverse' : '' ?>" href="#"
                       role="button" id="dropdownMenuLink"
                       data-toggle="dropdown"
                       aria-haspopup="true"
                       aria-expanded="false">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/flags/' . $lang . '.png' ?>" alt="Flag">
                        <span class="mx-1 h5 mb-0 text-color-1 text-uppercase"><?php echo $lang ?></span>
                        <span class="icon-arrowdown text-color-1"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-<?php echo is_rtl() ? 'left' : 'right' ?>" aria-labelledby="dropdownMenuLink" style="min-width: 80px !important;">
						<?php foreach ( $languages as $code => $language ) :
							if ( $code === $lang ) {
								continue;
							}

							?>
                            <a class="dropdown-item d-flex align-items-center p-1 <?php echo is_rtl() ? 'flex-row-reverse' : '' ?>"
                               href="<?php echo esc_url( wpm_translate_current_url( $code ) ); ?>">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/flags/' . $code . '.png' ?>" alt="Flag">
                                <span class="mx-1 h5 mb-0 text-color-1"><?php echo $language['name'] ?></span>
                            </a>
						<?php endforeach; ?>


                    </div>
                </div>

			<?php endif; ?>

        </div>
    </div>
</header>

<?php if ( ! is_front_page() && ! is_page_template( 'page-thanks.php' ) && ! is_page_template( 'page-signin.php' ) && ! is_404() ) : ?>
    <div <?php echo sogo_print_bg( array( 'url' => get_field( '_sogo_title_background', 'option' ), 'position' => 'center top' ) ) ?>>
		<?php get_template_part( 'templates/component', 'breadcrumbs' ); ?>
        <div class="container">
            <h1 class="d-inline-block pt-2 text-white s-title-<?php echo is_rtl() ? 'right' : 'left' ?> s-title-color-white">
				<?php if ( is_home() ):
					if ( isset( $_GET['s'] ) && ! empty( $_GET['s'] ) ) {
						echo __( 'Search Results for', 'sogoc' ) . ': ' . get_search_query();
					} else {
						the_field( '_sogo_' . get_post_type() . '_title', 'option' );
					}
                elseif ( is_post_type_archive( 'therapists' ) ):
					_e( 'Find therapists', 'sogoc' );
                elseif ( is_page_template( 'page-profile.php' ) ):
					echo get_the_title(); //  . ' - ' . get_the_title( get_query_var( 'post_id' ) )
                elseif ( is_page_template( 'page-signup.php' ) ):
					echo get_the_title() . ' ' . ( $_GET['type'] === 'family' ? __( 'Family', 'sogoc' ) : __( 'Therapist', 'sogoc' ) );
                elseif ( is_search() ):
					echo printf( __( 'Search Results for: %s', 'sogoc' ), get_search_query() );
				else:
					the_title();
				endif; ?>
            </h1>
			<?php if ( is_post_type_archive( 'therapists' ) ): ?>
                <div class="pb-3 d-block"><?php include "templates/component-search.php"; ?></div>
			<?php endif; ?>
        </div>
    </div>
<?php endif; ?>


<script>
    (function ($) {
        'use strict';
        $(document).ready(function () {
            /*
            * HEADER MENU
             */

            // var sticky = document.getElementById('sticky-header');
            // stickybits(sticky);

            var $expandsub = $('.expand-sub');
            var $body = $('body');

            $('.js-hamburger').on('click', function () {
                $(this).toggleClass('is-active');
                $('.primary-menu').toggleClass('is-active')
            });


            function temp(obj) {
                var $this = obj;
                $this.find('i').toggleClass('is-active');
                $this.find('.sub-menu').slideToggle('fast')
            }

            $expandsub.on('keypress', function (e) {
                if (e.keyCode === 13) {
                    temp($(this));
                }
            });

            $expandsub.on('click', function (e) {
                temp($(this));
            });


            $body.on('keyup', function (e) {
                if (e.keyCode === 27) {
                    $expandsub.find('i').removeClass('is-active');
                    $expandsub.find('.sub-menu').slideUp('fast')
                }
            });


        });
    })(jQuery);
</script>

