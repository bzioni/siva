<!--<form action="--><?php //echo get_permalink( get_option( 'page_for_posts' ) ) ?><!--" method="get" class="position-relative mb-3">-->
<!--    <label for="s" class="sr-only">--><?php //_e( 'Search', 'sogoc' ) ?><!--</label>-->
<!--    <input class="border-top-0 border-right-0 border-left-0 border-color-2 bg-transparent w-100 py-1 pr-2 pl-4" type="text" name="s" id="s" value="--><?php //the_search_query(); ?><!--" placeholder="--><?php //_e('Search in blog', 'sogoc') ?><!--"/>-->
<!--    <button type="submit" class="bg-transparent border-0 position-absolute y-align pos-l-1"><span class="icon-search icon-xs text-color-3"></span></button>-->
<!--</form>-->
<!---->

<form role="search" method="get" id="searchform" class="searchform mx-auto mb-3" action="<?php echo get_permalink( get_option( 'page_for_posts' ) ) ?>">
    <div>
        <label for="s" class="sr-only"><?php _e( 'Search', 'sogoc' ) ?></label>
        <input type="text" value="<?php echo get_search_query() ?>" placeholder="<?php _e( 'Search', 'sogoc' ) ?>" name="s" id="s"/>
        <!--        <input type="hidden" name="post_type" value="--><?php //echo get_post_type() ?><!--"/>-->
        <button type="submit" id="searchsubmit" value="Searchform"><span class="icon-search xy-align text-color-3 icon-xs"></span>
        </button>
    </div>
</form>
