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

                                        $cat = get_term_by( 'id', get_field('main_category', get_the_ID()), 'venue-category' );

                                        $cat_name =  (!empty($cat) && !is_wp_error($cat)) ? $cat->name : get_the_title(); ?>

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
                        <?php

                        global $wp_query;

                        WEPN_Helper::wepn_pagination($wp_query->max_num_pages); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <aside class="l-sidebar">
                    <?php if (of_get_option('video_venue', '')) {?>
                        <div class="widget">
                            <a href="#main_vid" role="button" data-toggle="modal" class="btn btn-primary btn-block mb-20"><span class="fa fa-play-circle icon-l-sm"></span>WEPN Venue Video</a>
                        </div>
                    <?php } ?>
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

<?php if (of_get_option('video_venue', '')) {?>
    <div id="main_vid" class="modal modal-md fade in " tabindex="-1" role="dialog" aria-labelledby="<?php echo of_get_option('video_venue_text', ''); ?>">
      <div class="modal-dialog modal-lg">
      <div class="modal-content">
              <div class="modal-header t-normal">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h3 class="t-title text-center"><?php echo of_get_option('video_venue_text', ''); ?></h3>
                  </div>
              <div class="modal-body">
                  <?php echo of_get_option('video_venue', ''); ?>
              </div>
       </div>
      </div>
    </div>
<?php } ?>

<?php get_footer(); ?>
