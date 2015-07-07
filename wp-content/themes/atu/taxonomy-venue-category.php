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

get_header();

?>
<div class="l-content-bg" >
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
                        <div class="post post-block">
                            <div class="row">

                                <?php if ( have_posts() ) : ?>

                                    <?php



                                    // Start the Loop.
                                    while ( have_posts() ) : the_post();
                                        $cat_name = get_the_title();
                                        $cats = get_the_terms( get_the_ID(), 'venue-category' );
                                        if ( ! empty( $cats ) ) {
                                            $cat_name = $cats[0]->name;
                                        }
                                        ?>

                                        <div class="col-md-4 col-sm-6">
                                            <div class="post-item well-block" style="border-bottom: 3px solid <?php the_field( 'color' ); ?>">
                                                <div class="well-header"><?php echo $cat_name; ?></div>
                                                <div class="post-img">
                                                    <a href="<?php the_permalink(); ?>"><?php do_action('aut_post_thumnail', 'venue-listing'); ?></a>
                                                </div>
                                                <div class="post-content t-sm">
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
                        <?php  do_action( 'atu_pagination' ); ?>
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
