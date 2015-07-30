<aside class="l-sidebar">
    <?php if (!is_user_logged_in() ) { ?> 
      <div class="widget">
          <a href="<?php echo wp_login_url();?>" class="btn btn-primary btn-block">Member Login</a>
          <a href="<?php echo get_permalink(492);?>" class="btn btn-primary btn-block mb-20">Become a Member</a>
      </div>
    <?php } ?>
	<div class="widget widget-aside widget-post">
        <div class="widget-header"><?php _e( 'Latest Suppliers', 'atu'); ?></div>

        <?php
        /**
         * Get latest vendors
         */
        $wp_venue_query = new WP_Query( array( 'post_type' => 'vendor',
                    'order' => 'DESC',
                    'orderby' => 'meta_value_num',
                    'meta_key' => 'vendor', 'post_status' => 'publish', 'posts_per_page' =>5 ) );


        if ( $wp_venue_query->have_posts(  ) ): ?>

            <ul class="post-inline-sm xx">

                <?php while( $wp_venue_query->have_posts() ): $wp_venue_query->the_post();

                    $main_cat = get_post_meta(get_the_ID(), 'category', true );
                    $taxonomy = get_post_meta(get_the_ID(), 'city', true);
                    $cat = get_term_by( 'slug', $main_cat, $taxonomy );


                    $user_id = get_post_meta(get_the_ID(), 'vendor', true);

                    $cat_name = !is_wp_error($cats) ? $cat->name : '';


                    $image_id = get_user_meta( $user_id, 'profile_image', true );

                    ?>
                    <li class="post-item">
                        <div class="post-img">
                            <a href="<?php the_permalink(); ?>"><?php echo wp_get_attachment_image( $image_id, 'venue-xs-small-thumb' ); ?></a>
                        </div>
                        <div class="post-core">
                            <div class="post-title"><a href="<?php the_permalink(); ?>" class="link"><?php echo content(get_the_title(),4); ?></a></div>
                            <p><?php echo $cat_name; ?></p>
                        </div>
                    </li>
                <?php endwhile; wp_reset_query();?>
            </ul>

        <?php else: ?>

            <h3><?php _e( 'No Suppliers found.', 'atu' ); ?></h3>

        <?php endif; ?>

	</div>

	<div class="widget widget-aside widget-post">
		<div class="widget-header"><?php _e( 'Latest Venue', 'atu' ); ?></div>

        <?php
        /**
         * Get latest venue
         */
        $wp_venue_query = new WP_Query( array( 'post_type' => 'venue', 'orderby' => 'date', 'order' => 'desc', 'post_status' => 'publish', 'posts_per_page' =>5 ) );


        if ( $wp_venue_query->have_posts(  ) ): ?>

		<ul class="post-inline-sm">

            <?php while( $wp_venue_query->have_posts() ): $wp_venue_query->the_post();

                $cat = get_term_by( 'id', get_field('main_category', get_the_ID()), 'venue-category' );

                $cat_name = (!empty($cat) && !is_wp_error($cat)) ? $cat->name : get_the_title();

                ?>
			<li class="post-item">
				<div class="post-img">
					<a href="<?php the_permalink(); ?>"><?php do_action( 'aut_post_thumnail', 'venue-xs-small-thumb' ); ?></a>
				</div>
				<div class="post-core">
					<div class="post-title"><a href="<?php the_permalink(); ?>" class="link"><?php echo content(get_the_title(),4); ?></a></div>
					<p><?php echo $cat_name; ?></p>
				</div>
			</li>
            <?php endwhile; wp_reset_query();?>
		</ul>

        <?php else: ?>

            <h3><?php _e( 'No Venue found.', 'atu' ); ?></h3>

        <?php endif; ?>
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