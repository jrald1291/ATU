<?php
/**
 * Template Name: Contact Page
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>



<?php 
	$bg = of_get_option('banner', '');
	$page_bg = wp_get_attachment_image_src(get_field('page_background'),'large');
	$page_bg = $page_bg[0];
	if (!$page_bg) {
		$page_bg = $bg;
	}
	if ($page_bg== "" and $bg == "") {
		$page_bg = get_template_directory_uri()."/assets/images/banner.jpg";
	}
$user_id ="";
if(isset($_GET["user_id"])){
	$user_id = $_GET["user_id"];
}
$current_user = wp_get_current_user();

$user_info = get_user_meta( $current_user->$user_id );

?>

<div class="l-content-bg" style="background: url('<?php echo $page_bg; ?>') no-repeat"> 
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<div class="l-content-container">
					<div class="page-header">
						<div class="row">
							<div class="col-md-6">
								<button class="btn btn-secondary btn-block" data-toggle="modal" data-target=".form-venue">Search Venue</button>
							</div>
							<div class="col-md-6">
								<button class="btn btn-secondary btn-block" data-toggle="modal" data-target=".form-vendor">Search Vendor</button>
							</div>
						</div>	
					</div>
					<div class="page-content">
						<div class="page-title ">
							<h2 class="t-lg">Contact Details</h2>
						</div>
						<?php if (isset($_GET["user_id"])) { ?>	
							<div class="section section-contact">
								<div class="contact-avatar">
									<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/contact-avatar.jpg" alt="">
								</div>
								<div class="contact-name"> <?php echo $current_user->phone ?></div>
								<div class="contact-content">Call me if you prefer to speak to a real life person</div>
								<ul class="list list-contact list-inline">
									<li>
										<a href=""><span class="fa fa-phone icon-l-sm"> :</span>340 6566 000 </a>
									</li>
									<li>
										<a href=""><span class="fa fa-mobile icon-l-sm"></span>340 6566 000 </a>
									</li>
									<li>
										<a href=""><span class="fa fa-envelope icon-l-sm"></span>info.yourweddingalltiedup.com.au </a>
									</li>
								</ul>
							</div>
						<?php } ?>					
						<?php echo do_shortcode('[contact-form-7 id="186" title="Contact" html_class="form form-labeled"]'); ?>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<?php get_template_part('sidebar','secondary') ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>


