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
// Current URL for setting up Search Form Action
global $wp;

?>
asdf
<div class="l-content-bg" >
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="l-content-container">
                    <div class="page-header">
                        <form action="<?php echo home_url( '/' ); ?>" class="form">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="s" class="form-control input-block" placeholder="Keyword...">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="input-group">
                                        <div class="input-group-addon">Venue Category</div>
                                        <?php wp_dropdown_categories( array(
                                            'taxonomy'  => 'venue-category',
                                            'hide_empty'         => 0,
                                            'class'              => 'form-control',
                                            'show_option_none'   => '',
                                            'option_none_value'  => '-1',
                                        ) ); ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <input type="hidden" name="post_type" value="venue">
                                    <button class="btn btn-secondary btn-block" ><span class="fa fa-search icon-l"></span>Search Venue</button>
                                </div>
                            </div>
                        </form>
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
                                            <div class="post-item well-block" style="border-bottom: 3px solid #32a69f">
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
                        <?php
                        global $wp_query;
                        // Get post type archive link
                        $post_type_archive_link = get_post_type_archive_link( 'venue' );
                        // Get maximum number of page
                        $total_row = $wp_query->max_num_pages;
                        // Set row per page
                        $per_page = 12;
                        // Get total page
                        $total_page = ceil( $total_row / $per_page );
                        // Get current page
                        $current_page = get_query_var('paged') ? get_query_var('paged') : 1;
                        // Get next page
                        $next_page = $total_page <= $current_page ? $current_page : $current_page + 1;
                        ?>
                        <div class="pagination">
                            <label for="">Pagination :</label>
                            <div class="wp-pagenavi">
                                <span class="pages"><?php echo 'Page '. $current_page .' of '. $total_page; ?></span>

                                <?php for( $i = 1; $i <= $total_page; $i++ ): ?>

                                    <?php if ( $i == $current_page ):  ?>

                                        <span class="current"><?php echo $i; ?></span>

                                        <?php else: ?>

                                        <a class="page larger" href="<?php echo $post_type_archive_link  .'page/'. $i; ?>"><?php echo $i; ?></a>

                                        <?php endif; ?>

                                <?php endfor; ?>

                                <a class="nextpostslink" rel="next" href="<?php echo $post_type_archive_link  .'page/'. $next_page; ?>">Next</a>
                            </div>
                        </div>
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
