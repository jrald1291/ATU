<?php get_header();


?>


<div class="l-content-bg" style="background: url('<?php WEPN_Helper::background_image( get_field('page_background', get_the_ID()) ); ?>') no-repeat">
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
                    <?php if (!is_user_logged_in() ) { ?> 
                      <div class="widget">
                          <a href="<?php echo wp_login_url();?>" class="btn btn-primary btn-block">Member Login</a>
                          <a href="<?php echo get_permalink( get_page_by_title( 'Become a Member' ));?>" class="btn btn-primary btn-block mb-20">Become a Member</a>
                      </div>
                    <?php } ?>
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

                   <div class="widget widget-aside">
                      <div class="widget-header">Signup for Newsletter</div>
                      <div class="widget-body">
                  		<div class="form form-labeled">
                  			<?php echo do_shortcode('[mc4wp_form]'); ?>
                          </div>
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


