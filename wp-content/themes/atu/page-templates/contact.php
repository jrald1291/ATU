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
						<div class="section section-contact">
							<div class="contact-avatar">
								<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/contact-avatar.jpg" alt="">
							</div>
							<div class="contact-name"> Hi! I am Jacie Witfield</div>
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
						<form action="" class="form form-labeled">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group field-wrap">
										<label for="">Name<span class="req">*</span></label>
										<input type="text" class="form-control">
									</div>
									<div class="form-group field-wrap">
										<label for="">Email<span class="req">*</span></label>
										<input type="text" class="form-control">
									</div>
									<div class="form-group">
										<label for="" class="label-drop">Event Type<span class="req">*</label>
										<select class="form-control" name="" id="">
											<option value="">test</option>
										</select>
									</div>
									<div class="form-group">
										<label for="" class="label-drop">Who do you need?<span class="req">*</label>
										<select class="form-control" name="" id="">
											<option value="">test</option>
										</select>
									</div>
									<div class="form-group">
										<label for="" class="label-drop">Date of Event<span class="req">*</label>
										<input type="date" class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group field-wrap">
										<label for="">Phone<span class="req">*</span></label>
										<input type="text" class="form-control">
									</div>
									<div class="form-group field-wrap">
										<label for="">Address<span class="req">*</span></label>
										<input type="text" class="form-control">
									</div>
									<div class="form-group field-wrap">
										<label for="">Address<span class="req">*</span></label>
										<textarea name="" class="form-control" id="" rows="10"></textarea>
									</div>
								</div>
							</div>
							<button class="btn btn-primary btn-block btn-lg" >Send Message</button>
						</form>

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
<script>
	 new CBPGridGallery( document.getElementById( 'grid-gallery' ) );
</script>