<?php get_header();


?>


<div class="l-content-bg" style="background: url('<?php ATU_Helper::background_image( get_field('page_background', get_the_ID()) ); ?>') no-repeat">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="l-content-container">

                    <div class="page-content">
                        <?php if ( have_posts() ) : ?>
                            <div class="post post-block">
                                <div class="row">
                                    <?php
                                    // Start the loop.
                                    while ( have_posts() ) : the_post(); ?>

                                        <?php
                                        /*
                                         * Run the loop for the search to output the results.
                                         * If you want to overload this in a child theme then include a file
                                         * called content-search.php and that will be used instead.
                                         */
                                        get_template_part( 'content', 'search' );

                                        // End the loop.
                                    endwhile;


                                    ?>

                                </div>
                            </div>

                        <?php
                            // Previous/next page navigation.
                            the_posts_pagination( array(
                                'prev_text'          => __( 'Previous page', 'twentyfifteen' ),
                                'next_text'          => __( 'Next page', 'twentyfifteen' ),
                                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>',
                            ) );

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
                        <div class="widget-header">Venue Types</div>
                        <ul class="list">
                            <?php wp_list_categories('taxonomy=venue-category&orderby=name&title_li=0'); ?>

                        </ul>
                    </div>

                    <div class="widget widget-aside well-widget">
                        <div class="form form-labeled">
                            <?php echo do_shortcode('[mc4wp_form]'); ?>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>



<?php get_footer(); ?>


