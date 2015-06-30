<?php
/**
 * Template Name: Contact
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>


<div class="l-content-bg">
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<div class="l-content-container">
					<div class="page-header">
						<div class="row">
							<div class="col-md-6">
								<button class="btn btn-secondary btn-block" data-toggle="modal" data-target=".form-venue"><span class="fa fa-search icon-l"></span>Search Venue</button>
							</div>
							<div class="col-md-6">
								<button class="btn btn-secondary btn-block" data-toggle="modal" data-target=".form-vendor"><span class="fa fa-search icon-l"></span>Search Vendor</button>
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
				<aside class="l-sidebar">
					<div class="widget widget-aside widget-post">
						<div class="widget-header">Latest Vendor</div>
						<ul class="post-inline-sm">
							<li class="post-item">
								<div class="post-img">
									<a href=""><img src="<?php echo get_template_directory_uri() ?>/images/placeholders/vendor_thumb1.jpg" width='60' height='60' alt=""></a>
								</div>
								<div class="post-core">
									<a href="#" class="link"><div class="post-title">John Doe Lorem Ipsom</a>
									<p>Accessories</p>
								</div>
							</li>
							<li class="post-item">
								<div class="post-img">
									<a href=""><img src="<?php echo get_template_directory_uri() ?>/images/placeholders/vendor_thumb2.jpg" width='60' height='60' alt=""></a>
								</div>
								<div class="post-core">
									<a href="#" class="link"><div class="post-title">John Doe Lorem Ipsom</a>
									<p>Accessories</p>
								</div>
							</li>
							<li class="post-item">
								<div class="post-img">
									<a href=""><img src="<?php echo get_template_directory_uri() ?>/images/placeholders/vendor_thumb3.jpg" width='60' height='60' alt=""></a>
								</div>
								<div class="post-core">
									<a href="#" class="link"><div class="post-title">John Doe Lorem Ipsom</a>
									<p>Accessories</p>
								</div>
							</li>
							<li class="post-item">
								<div class="post-img">
									<a href=""><img src="<?php echo get_template_directory_uri() ?>/images/placeholders/vendor_thumb4.jpg" width='60' height='60' alt=""></a>
								</div>
								<div class="post-core">
									<a href="#" class="link"><div class="post-title">John Doe Lorem Ipsom</a>
									<p>Accessories</p>
								</div>
							</li>
							<li class="post-item">
								<div class="post-img">
									<a href=""><img src="<?php echo get_template_directory_uri() ?>/images/placeholders/vendor_thumb1.jpg" width='60' height='60' alt=""></a>
								</div>
								<div class="post-core">
									<a href="#" class="link"><div class="post-title">John Doe Lorem Ipsom</a>
									<p>Accessories</p>
								</div>
							</li>
						</ul>
					</div>
					<div class="widget widget-aside widget-post">
						<div class="widget-header">Latest Venue</div>
						<ul class="post-inline-sm">
							<li class="post-item">
								<div class="post-img">
									<a href=""><img src="<?php echo get_template_directory_uri() ?>/images/placeholders/vendor_thumb1.jpg" width='60' height='60' alt=""></a>
								</div>
								<div class="post-core">
									<a href="#" class="link"><div class="post-title">Lorem ipsum dolor sit</a>
									<p>Beach</p>
								</div>
							</li>
							<li class="post-item">
								<div class="post-img">
									<a href=""><img src="<?php echo get_template_directory_uri() ?>/images/placeholders/vendor_thumb2.jpg" width='60' height='60' alt=""></a>
								</div>
								<div class="post-core">
									<a href="#" class="link"><div class="post-title">Lorem ipsum dolor sit</a>
									<p>Restaurant</p>
								</div>
							</li>
							<li class="post-item">
								<div class="post-img">
									<a href=""><img src="<?php echo get_template_directory_uri() ?>/images/placeholders/vendor_thumb3.jpg" width='60' height='60' alt=""></a>
								</div>
								<div class="post-core">
									<a href="#" class="link"><div class="post-title">Lorem ipsum dolor sit</a>
									<p>Barn</p>
								</div>
							</li>
							<li class="post-item">
								<div class="post-img">
									<a href=""><img src="<?php echo get_template_directory_uri() ?>/images/placeholders/vendor_thumb4.jpg" width='60' height='60' alt=""></a>
								</div>
								<div class="post-core">
									<a href="#" class="link"><div class="post-title">Lorem ipsum dolor sit</a>
									<p>Lorem ipsum</p>
								</div>
							</li>
							<li class="post-item">
								<div class="post-img">
									<a href=""><img src="<?php echo get_template_directory_uri() ?>/images/placeholders/vendor_thumb1.jpg" width='60' height='60' alt=""></a>
								</div>
								<div class="post-core">
									<a href="#" class="link"><div class="post-title">Lorem ipsum dolor sit</a>
									<p>Lorem ipsum </p>
								</div>
							</li>
						</ul>
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
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
<script>
	 new CBPGridGallery( document.getElementById( 'grid-gallery' ) );
</script>