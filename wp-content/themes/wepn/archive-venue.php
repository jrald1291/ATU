<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header();?>


<div class="l-content-bg" style="background: url('<?php WEPN_Helper::background_image( get_field('page_background', get_the_ID()) ); ?>') no-repeat">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="l-content-container">
                    <div class="page-header">
                        <?php
                        /**
                         * Find Venue form
                         */
                        do_action( 'wepn_venue_search_form' ); ?>
                    </div>
                    <div class="page-content">
                        <div class="post post-block">
                            <div class="row">

                                <?php if ( have_posts() ) : ?>

                                    <?php



                                    // Start the Loop.
                                    while ( have_posts() ) : the_post();

                                        $cat_name = get_the_title();

                                        $cats = get_the_terms( get_the_ID(), 'venue-category' );
                                        if ( ! empty( $cats ) )$cat_name = $cats[0]->name;
                                        ?>

                                        <div class="col-md-4 col-sm-6">
                                            <div class="post-item well-block" style="border-bottom: 3px solid <?php echo hex2rgba(get_field( 'color')); ?>">
                                                <div class="well-header"><div class="marquee"><span><?php echo $cat_name; ?></span></div></div>
                                                <div class="post-img">
                                                    <a href="<?php the_permalink(); ?>"><?php do_action('aut_post_thumnail', 'img-avatar'); ?></a>
                                                </div>
                                                <div class="post-content t-sm marquee">
                                                    <a href="<?php the_permalink(); ?>" class="post-name"><?php the_title(); ?></a>
                                                </div>
                                            </div>
                                        </div>


                                    <?php

                                        // End the loop.
                                    endwhile;

                                // If no content, include the "No posts found" template.
                                else :
                                    get_template_part( 'content', 'none' );

                                endif;
                                ?>
                            </div>
                        </div>
                        <?php  do_action( 'wepn_pagination' ); ?>
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
                            <div class="well-header">Subscribe to our Newsletter</div>
                            <?php echo do_shortcode('[mc4wp_form]'); ?>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>



<?php get_footer(); ?>
