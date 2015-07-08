<?php get_header(); ?>

<?php 
    $bg = of_get_option('banner', '');
    $page_bg = wp_get_attachment_image_src(get_field('page_background'),'large');
    $page_bg = $page_bg[0];
    if (!$page_bg) {
        $page_bg = $bg;
    }
    if ($page_bg== "" and $bg == "") {
        $page_bg = get_template_directory_uri()."/assets/images/banner.jpg";
    }

?>
<div class="l-content-bg" style="background: url('<?php echo $page_bg; ?>') no-repeat"> 
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="l-content-container">
                    <div class="page-header">
                        <?php
                        /**
                         * Search venue form
                         */
                        do_action( 'atu_venue_search_form' ); ?>
                    </div>
                    <div class="page-content">
                        <?php if ( have_posts() ) : ?>
                            <div class="post post-block">
                                <div class="row">
                            <?php
                            // Start the loop.
                            while ( have_posts() ) : the_post(); ?>

                                <?php


                                // check to see if there was a post type in the
                                // URL string and if a results template for that
                                // post type actually exists
                                if ( isset( $_REQUEST['post_type'] ) && locate_template( 'search-' . $_REQUEST['post_type'] . '.php' ) ) {

                                    // if so, load that template
                                    get_template_part('search', $_REQUEST['post_type']);
                                } elseif ( isset( $_REQUEST['tax'] ) && locate_template( 'taxonomy-' . $_REQUEST['tax'] . '.php' ) ) {
                                    get_template_part('taxonomy', $_REQUEST['tax']);
                                } else {

                                    /*
                                     * Run the loop for the search to output the results.
                                     * If you want to overload this in a child theme then include a file
                                     * called content-search.php and that will be used instead.
                                     */
                                    get_template_part('content', 'search');
                                }

                                // End the loop.
                            endwhile;
                            ?>

                                </div>
                            </div>

                        <?php
                            do_action( 'atu_pagination' );

                        // If no content, include the "No posts found" template.
                        else :
                            get_template_part( 'content', 'none' );

                        endif;
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <aside class="l-sidebar">
                    <div class="widget widget-aside widget-list">
                        <div class="widget-header">Vendor Categories</div>
                        <ul class="list">
                            <?php wp_list_categories('taxonomy=venue-category&orderby=name&title_li=0'); ?>

                        </ul>
                    </div>
                    <div class="widget widget-aside well-widget">
                        <form action="" class="form form-labeled">
                            <div class="well-header">Subscribe to our Newsletter</div>
                            <div class="form-group field-wrap">
                                <label for="">Email Address</label>
                                <input type="text" class="form-control">
                            </div>
                            <button class="btn btn-primary btn-block">Subscribe now</button>
                        </form>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>



<?php get_footer(); ?>


