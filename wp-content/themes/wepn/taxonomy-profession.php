<?php

get_header(); ?>


<div class="l-content-bg" style="background: url('<?php WEPN_Helper::background_image( get_field('page_background', get_the_ID()) ); ?>') no-repeat">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="l-content-container">
                    <div class="page-header">
                        <?php do_action( 'wepn_vendor_search_form' ); ?>
                    </div>
                    <div class="page-content">

                        <?php

                            /*
                             * Include the post format-specific template for the content. If you want to
                             * use this in a child theme, then include a file called called content-___.php
                             * (where ___ is the post format) and that will be used instead.
                             */
                            get_template_part( 'content', 'vendor' );


                        ?>



                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <aside class="l-sidebar">
                    <?php if (!is_user_logged_in() ) { ?> 
                      <div class="widget">
                          <a href="<?php echo wp_login_url();?>" class="btn btn-primary btn-block">Member Login</a>
                          <a href="<?php echo get_permalink(492);?>" class="btn btn-primary btn-block mb-20">Become a Member</a>
                      </div>
                    <?php } ?>
                    <?php if (of_get_option('video_diff', '')) {?>
                        <div class="widget">
                            <a href="#main_vid" role="button" data-toggle="modal" class="btn btn-primary btn-block mb-20"><span class="fa fa-play-circle icon-l-sm"></span> Why we are Different</a>
                        </div>
                    <?php } ?>
                    <div class="widget widget-aside widget-list">
                        <div class="widget-header">Supplier Types</div>
                        <?php WEPN_Helper::list_vendor_category(); ?>
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
<?php if (of_get_option('video_diff', '')) {?>
    <div id="main_vid" class="modal modal-md fade in " tabindex="-1" role="dialog" aria-labelledby="<?php echo of_get_option('video_diff_text', ''); ?>">
      <div class="modal-dialog modal-lg">
      <div class="modal-content">
              <div class="modal-header t-normal">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h3 class="t-title text-center"><?php echo of_get_option('video_diff_text', ''); ?></h3>
                  </div>
              <div class="modal-body">
                  <?php echo of_get_option('video_diff', ''); ?>
              </div>
       </div>
      </div>
    </div>
<?php } ?>
<?php get_footer(); ?>
<script>
    new CBPGridGallery( document.getElementById( 'grid-gallery' ) );
</script>