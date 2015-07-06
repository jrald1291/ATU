<aside class="l-sidebar">
	<div class="widget widget-aside widget-post">
        <div class="widget-header"><?php _e( 'Latest Vendor', 'atu'); ?></div>
        <?php
        /**
         * Get all vendor user
         * @var  $user_query */
        $wp_user_query = new WP_User_Query( array( 'role' => get_option( 'atu_default_user_role', 'vendor' ), 'number' => 4 ) );

        // Get the results
        $vendors = $wp_user_query->get_results();


        if ( ! empty( $vendors ) ): ?>

            <ul class="post-inline-sm">

                <?php foreach( $vendors as $vendor ):

                    $vendor_info = get_userdata($vendor->ID);
                    $description = wp_trim_words(  get_user_meta( $vendor->ID, 'description', true ), $num_words = 20, $more = '...' );
                    $profession = '';
                    $categories = wp_get_object_terms( $vendor->ID, 'profession', false );
                    if ( !empty( $categories ) ) {
                        $profession = $categories[0]->name;
                    }
                    $image_id = get_user_meta( $vendor->ID, 'profile_image', true );
                    ?>
                    <li class="post-item">
                        <div class="post-img">
                            <?php echo wp_get_attachment_image( $image_id, 'vendor-small-thumb' ); ?>
                        </div>
                        <div class="post-core">
                            <a href="#" class="link"><div class="post-title"><?php echo $vendor_info->first_name .' '. $vendor_info->last_name; ?>
                                    </div></a>
                            <p><?php echo $profession; ?></p>
                        </div>
                    </li>

                <?php endforeach; ?>
            </ul>



        <?php else: ?>

            <h3><?php _e( 'No vendors found.', 'atu'); ?></h3>
        <?php endif; ?>

	</div>

	<div class="widget widget-aside widget-post">
		<div class="widget-header"><?php _e( 'Latest Venue', 'atu' ); ?></div>

        <?php
        /**
         * Get latest venue
         */
        $wp_venue_query = new WP_Query( array( 'post_type' => 'venue', 'orderby' => 'date', 'order' => 'desc', 'post_status' => 'publish', 'posts_per_page' => -1 ) );


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
					<a href=""><?php do_action( 'aut_post_thumnail', 'venue-xs-small-thumb' ); ?></a>
				</div>
				<div class="post-core">
					<a href="#" class="link"><div class="post-title"<?php the_title(); ?></a>
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