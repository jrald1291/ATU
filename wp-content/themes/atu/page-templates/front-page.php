<?php
/**
 * Template Name: Front Page
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>
<?php 
	$bg = of_get_option('banner', '');
	$intro_img = wp_get_attachment_image_src(get_field('page_background'));

?>
<div class="section section-banner banner">
	<div class="banner-content">
		<div class="banner-actions">
			<h1 class="t-md t-title">
				<?php if (of_get_option('intro', '')): ?>
					<?php echo of_get_option('intro', ''); ?>
				<?php endif ?>
			</h1>
			<div class="actions">
				<button class="btn btn-wooden btn-lg" data-toggle="modal" data-target=".form-vendor">Search for Vendor</button>
				<button class="btn btn-wooden btn-lg" data-toggle="modal" data-target=".form-venue">Search for Venue</button>
			</div>
		</div>
		<?php if (get_field('banner_slogan') and get_field('slogan_line2')):?>
			<div class="banner-intro">
				<h2 class="t-title t-huge"><?php the_field('banner_slogan'); ?></h2>
				<h3 class="t-title t-md"><?php the_field('slogan_line2'); ?></h3>
			</div>
		<?php endif ?>
	</div>
	<a href="#scroll-target" class="t-upper scroll-down link scroll_to">Scroll Down</a>
</div>
<?php if (get_field('intro_text') and get_field('intro_image')):?>
	<div id="scroll-target" class="section section-l4">
		<div class="container">	
			<div class="col-sm-6 col-sm-push-6">
				<div class="well-img-bordered mb-30">
					<?php $intro_img = wp_get_attachment_image_src(get_field('intro_image'),'img-lscape'); ?>
					<img src="<?php echo $intro_img[0];?>"/>
				</div>
			</div>
			<div class="col-sm-6 col-sm-pull-6">
				<div class="t-title t-lg text-right t-reset">
	              <?php the_field('intro_text'); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="section section-dark section-fl section-l3 parallax">
<?php else: ?>
	<div id="scroll-target" class="section section-dark section-fl section-l3 parallax">
<?php endif ?>
	<div class="container">
		<h2 class="t-title t-huge mb-30">What is New Today?</h2>
		<div class="row">
			<div class="col-md-6 mb-30">
				<h4 class="title-l1">Latest Venue</h4>
				<div class="slider slider-l1 mb-20">
					<div class="slider-venue slider-capt flexslider mb-0">
					  <ul class="slides">
					    <li>
					    	<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/slide.jpg" alt=""> 
					    	<div class="slider-caption">
					    		<a href="#" class="link"><div class="slide-title">Tincidunt ut laoreet dolore</div></a>
					    		<div class="slide-desc">Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse... <a href="">read more</a></div>
					    	</div>	
					    </li>
					     <li>
					    	<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/slide.jpg" alt=""> 
					    	<div class="slider-caption">
					    		<a href="#" class="link"><div class="slide-title">Tincidunt ut laoreet dolore</div></a>
					    		<div class="slide-desc">Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse... <a href="">read more</a></div>
					    	</div>	
					    </li>
					     <li>
					    	<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/slide.jpg" alt=""> 
					    	<div class="slider-caption">
					    		<a href="#" class="link"><div class="slide-title">Tincidunt ut laoreet dolore</div></a>
					    		<div class="slide-desc">Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse... <a href="">read more</a></div>
					    	</div>	
					    </li>
					     <li>
					    	<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/slide.jpg" alt=""> 
					    	<div class="slider-caption">
					    		<a href="#" class="link"><div class="slide-title">Tincidunt ut laoreet dolore</div></a>
					    		<div class="slide-desc">Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse... <a href="">read more</a></div>
					    	</div>	
					    </li>
					  </ul>

					</div>
					<div id="carousel-venue" class="flexslider mb-0">
					 <ul class="slides">
						<li><img src="<?php echo get_template_directory_uri() ?>/images/placeholders/slide_thumb.jpg" alt=""> </li>
						<li><img src="<?php echo get_template_directory_uri() ?>/images/placeholders/slide_thumb.jpg" alt=""> </li>
						<li><img src="<?php echo get_template_directory_uri() ?>/images/placeholders/slide_thumb.jpg" alt=""> </li>
						<li><img src="<?php echo get_template_directory_uri() ?>/images/placeholders/slide_thumb.jpg" alt=""> </li>
						<li><img src="<?php echo get_template_directory_uri() ?>/images/placeholders/slide_thumb.jpg" alt=""> </li>
					 </ul>

					</div>
				</div>
				<a href="#" class="btn btn-opposite btn-block btn-md">See all venues</a>
			</div>
			<div class="col-md-6 mb-30">
				<h4 class="title-l1"><?php _e( 'Latest Vendor List', 'atu' ); ?> </h4>
                <?php
                /**
                 * Get all vendor user
                 * @var  $user_query */
                $wp_user_query = new WP_User_Query( array( 'role' => get_option( 'atu_default_user_role', 'vendor' ), 'number' => 4 ) );

                // Get the results
                $vendors = $wp_user_query->get_results();

                if ( ! empty( $vendors ) ): ?>
                    <ul class="post-inline post-member mb-20">
                        <?php foreach( $vendors as $vendor ):

                            $vendor_info = get_userdata($vendor->ID);

//                            echo '<pre>';
//                            print_r($vendor_info);
//                            echo '</pre>';
                            $description = wp_trim_words(  get_user_meta( $vendor->ID, 'description', true ), $num_words = 20, $more = '...' );
                            $profession = '';
                            $categories = wp_get_object_terms( $vendor->ID, 'profession', false );
                            if ( !empty( $categories ) ) {
                                $profession = $categories[0]->name;
                            }

                            ?>
                            <li class="post-item">
                                <div class="post-img well-img">
                                    <img src="<?php echo get_template_directory_uri() ?>/images/placeholders/vendor_thumb1.jpg" alt="">
                                </div>
                                <div class="post-core">
                                    <a href="#" class="link"><div class="post-title t-normal"><?php echo $vendor_info->first_name .' '. $vendor_info->last_name; ?> <span class="post-cat t-highlight"><?php echo $profession; ?></span></div></a>
                                    <p><?php echo $description; ?>.</p>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <a href="#" class="btn btn-opposite btn-block btn-md">See all Vendors</a>
                <?php else: ?>
                    <h3><?php _e( 'No vendors yet.', 'atu'); ?></h3>
                <?php endif; ?>



			</div>
		</div>
		
	</div>
</div>
<div class="section section-l4">
	<div class="container">
		<div class="t-md typo-lora text-center">
			<?php
			while ( have_posts() ) : the_post();
			?>
			<?php the_content(); ?>
			<?php endwhile; ?>
		</div>
	</div>
</div>



<?php get_footer(); ?>