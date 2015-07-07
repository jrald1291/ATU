<?php
/**
 * Template Name: Single
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
