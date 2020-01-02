<?php
function sogo_blog_load_more($page){


    $args = array(
        'post_type' => 'post',
        'paged' => $page,
        'posts_per_page' => 3,

    );
    $the_query = new WP_Query($args);
    $max_pages  = $the_query->max_num_pages > $page;
    if (!$the_query->have_posts()) {
        return false;
    }
    ?>
    <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="blog-box zoom-in-effect">
                <a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title()) ?>">
                    <div class="blog-img img-box">
                        <?php the_post_thumbnail('blog-image') ?>
                    </div>
                </a>
                <?php $categories = get_the_category(); ?>
                <div class="meta-cat"><?php  _e('Published','sogoc'); echo $categories[0]->name ?></div>
                <div class="meta-date">
                    <?php the_time(get_option('date_format')) ?>
                </div>
                <a href="<?php get_the_permalink() ?>" title="<?php echo esc_attr(get_the_title()) ?>">
                    <h3 class="blog-title bold"><?php the_title() ?></h3>
                </a>
            </div>
        </div>
    <?php endwhile; ?>
    <?php wp_reset_postdata();
    return $max_pages;
}


function ajax_load_more()
{
    ob_start();
    $max = sogo_blog_load_more($_POST['page']);
    echo json_encode(array(
        'max' => $max,
        'html' => ob_get_clean()
    ));
    die();
}
add_action('wp_ajax_ajax_load_more', 'ajax_load_more');
add_action('wp_ajax_nopriv_ajax_load_more', 'ajax_load_more');
