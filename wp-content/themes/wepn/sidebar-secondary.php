<aside class="l-sidebar">
	<div class="widget widget-aside widget-post">
        <div class="widget-header"><?php _e( 'Latest Vendor', 'atu'); ?></div>

        <?php
        /**
         * Get latest vendors
         */
        $wp_venue_query = new WP_Query( array( 'post_type' => 'vendor', 'orderby' => 'date', 'order' => 'desc', 'post_status' => 'publish', 'posts_per_page' =>5 ) );


        if ( $wp_venue_query->have_posts(  ) ): ?>

            <ul class="post-inline-sm">

                <?php while( $wp_venue_query->have_posts() ): $wp_venue_query->the_post();

                    $cat_name = get_the_title();

                    $user_id = get_post_meta( get_the_ID(), 'vendor', true );

                    $taxonomy = get_user_meta( $user_id, 'region', true );
                    $cats = get_the_terms( get_the_ID(), $taxonomy );

                    if ( ! empty( $cats ) )$cat_name = $cats[0]->name;


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

            <h3><?php _e( 'No Vendors found.', 'atu' ); ?></h3>

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

                $cat_name = get_the_title();
                $cats = get_the_terms( get_the_ID(), 'venue-category' );
                if ( ! empty( $cats ) ) {
                    $cat_name = $cats[0]->name;
                }

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
	<div class="widget widget-aside well-widget">
		<div class="form form-labeled">
			<?php echo do_shortcode('[mc4wp_form]'); ?>
        </div>
	</div>
</aside>