<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */


	$current_user = wp_get_current_user();

	$user_info = get_user_meta( $current_user->ID );

?>
<aside class="l-sidebar">
	<div class="widget widget-aside">
		<div class="ven-avatar">

			<?php
            // Get featured image
            if ( has_post_thumbnail() ) {
                the_post_thumbnail( 'venue-listing' );
            }
             ?>
			<div class="ven-name" data-color="#ff73b2"><?php the_title(); ?></div>
		</div>
	</div>
	<div class="widget widget-aside widget-list">
		<div class="widget-list_logo">
            <?php echo wp_get_attachment_image( get_field( 'company_logo' ),  'venue-listing' ); ?>
		</div>
		<div class="widget-header">Florist and Stylist</div>
		<ul class="list">
			<li><a href="tel:<?php the_field( 'mobile' ); ?>">Mobile: <?php the_field( 'mobile' ); ?></a></li>
			<li><a href="tel:<?php the_field( 'phone' ); ?>">Phone: <?php the_field( 'phone' ); ?></a></li>
			<li><a href="mailto:<?php the_field( 'email' ); ?>"><?php the_field( 'email' ); ?></a></li>
			<li><a href="<?php the_field( 'website' ); ?>" target="_blank"><?php the_field( 'website' ); ?></a></li>
		</ul>

	</div>
	<div class="widget widget-aside">
		<a href="<?php echo get_permalink( get_page_by_title( 'Contact' ))?>" class="btn btn-block btn-md btn-primary"><span class="fa icon-l fa-envelope"></span>Contact Vendor</a>
	</div>
	<div class="widget widget-aside">
		<a href="<?php the_field( 'website' ); ?>" target="_blank" class="btn btn-sm btn-block btn-secondary"><span class="fa icon-l-sm fa-globe"></span>Visit website</a>
	</div>
	<div class="widget widget-aside">
		<div class="call-to-action">
			<span class="icon icon-tel"></span>
			<p>Any questions?</p>
			<p>Call US Now</p>
			<p><a href="">0405 421 387</a></p>
		</div>
	</div>
</aside>