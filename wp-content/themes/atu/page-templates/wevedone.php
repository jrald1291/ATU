<?php
/**
 * Template Name: What weve done
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
						<div class="filter-button-group button-group js-radio-button-group">
						    <button class="button" data-filter="*">show all</button>
						    <button class="button is-checked" data-filter=".weddings">Weddings</button>
						</div>
						<div class="grid">
							<div class="element-item grid-item weddings">
								<div class="grid-img">
									<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/iso1.jpg" alt="">
									<div class="grid-title">
										Jane quarta decima
									</div>
								</div>	
								<div class="grid-content">
									<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </p>
									<p>Ut wisi enim ad minim veniam, quis nostrud exerci tation </p>
								</div>
							</div>
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
<script>
	 new CBPGridGallery( document.getElementById( 'grid-gallery' ) );
</script>