<?php
/**
 * Template Name: Venue Listing
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<?php 
	while ( have_posts() ) : the_post();
		$bg = of_get_option('banner', '');
		$page_bg = wp_get_attachment_image_src(get_field('page_background',36),'large');
		$page_bg = $page_bg[0];
		if (!$page_bg) {
			$page_bg = $bg;
		}
		if ($page_bg == "" and $bg == "") {
			$page_bg = get_template_directory_uri()."/assets/images/banner.jpg";
		}
	endwhile;
	wp_reset_postdata();
?>

<div class="l-content-bg" style="background: url('<?php echo $page_bg; ?>') no-repeat"> 
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<div class="l-content-container">
					<div class="page-header">
						<form action="" class="form">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<input type="text" class="form-control input-block" placeholder="Keyword...">
									</div>
								</div>
								<div class="col-md-5">
									<div class="input-group">
										<div class="input-group-addon">Venue Category</div>
										<select class="form-control input-block" name="" id="">
											<option value="">test</option>
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<button class="btn btn-secondary btn-block" ><span class="fa fa-search icon-l"></span>Search Venue</button>
								</div>
							</div>						
						</form>
					</div>
					<div class="page-content">
						<div class="post post-block">
							<div class="row">
								<div class="col-md-4 col-sm-6">
									<div class="post-item well-block post-marquee" style="border-bottom: 3px solid #32a69f">
										<div class="well-header">Garden</div>
										<div class="post-img">
											<a href=""><img src="<?php echo get_template_directory_uri() ?>/images/placeholders/vendor1.jpg" alt=""></a>
										</div>
										<div class="post-content t-sm marquee">
											<a href="" class="post-name">Lorem ipsum dolor sit amet, consectetur adipisicing.</a>
										</div>
									</div>
								</div>
								<div class="col-md-4 col-sm-6">
									<div class="post-item well-block" style="border-bottom: 3px solid #a68432">
										<div class="well-header">Chapel</div>
										<div class="post-img">
											<a href=""><img src="<?php echo get_template_directory_uri() ?>/images/placeholders/vendor2.jpg" alt=""></a>
										</div>
										<div class="post-content t-sm">
											<a href="" class="post-name">Lorem ipsum dolor sit amet.</a>
										</div>
									</div>
								</div>
								<div class="col-md-4 col-sm-6">
									<div class="post-item well-block" style="border-bottom: 3px solid #6032a6">
										<div class="well-header">Cruise</div>
										<div class="post-img">
											<a href=""><img src="<?php echo get_template_directory_uri() ?>/images/placeholders/vendor3.jpg" alt=""></a>
										</div>
										<div class="post-content t-sm">
											<a href="" class="post-name">Lorem ipsum dolor sit amet.</a>
										</div>
									</div>
								</div>
								<div class="col-md-4 col-sm-6">
									<div class="post-item well-block" style="border-bottom: 3px solid #e545be">
										<div class="well-header">Historic</div>
										<div class="post-img">
											<a href=""><img src="<?php echo get_template_directory_uri() ?>/images/placeholders/vendor4.jpg" alt=""></a>
										</div>
										<div class="post-content t-sm">
											<a href="" class="post-name">Lorem ipsum dolor sit amet.</a>
										</div>
									</div>
								</div>
								<div class="col-md-4 col-sm-6">
									<div class="post-item well-block" style="border-bottom: 3px solid #a232a6">
										<div class="well-header">Golf Club</div>
										<div class="post-img">
											<a href=""><img src="<?php echo get_template_directory_uri() ?>/images/placeholders/vendor5.jpg" alt=""></a>
										</div>
										<div class="post-content t-sm">
											<a href="" class="post-name">Lorem ipsum dolor sit amet.</a>
										</div>
									</div>
								</div>
								<div class="col-md-4 col-sm-6">
									<div class="post-item well-block" style="border-bottom: 3px solid #a64832">
										<div class="well-header">Hotel</div>
										<div class="post-img">
											<a href=""><img src="<?php echo get_template_directory_uri() ?>/images/placeholders/vendor6.jpg" alt=""></a>
										</div>
										<div class="post-content t-sm">
											<a href="" class="post-name">Lorem ipsum dolor sit amet.</a>
										</div>
									</div>
								</div>
								<div class="col-md-4 col-sm-6">
									<div class="post-item well-block" style="border-bottom: 3px solid #fff000">
										<div class="well-header">Restaurant</div>
										<div class="post-img">
											<a href=""><img src="<?php echo get_template_directory_uri() ?>/images/placeholders/vendor7.jpg" alt=""></a>
										</div>
										<div class="post-content t-sm">
											<a href="" class="post-name">Lorem ipsum dolor sit amet.</a>
										</div>
									</div>
								</div>
								<div class="col-md-4 col-sm-6">
									<div class="post-item well-block" style="border-bottom: 3px solid #000">
										<div class="well-header">Function Centre</div>
										<div class="post-img">
											<a href=""><img src="<?php echo get_template_directory_uri() ?>/images/placeholders/vendor8.jpg" alt=""></a>
										</div>
										<div class="post-content t-sm">
											<a href="" class="post-name">Lorem ipsum dolor sit amet.</a>
										</div>
									</div>
								</div>
								<div class="col-md-4 col-sm-6">
									<div class="post-item well-block" style="border-bottom: 3px solid #35a632">
										<div class="well-header">Waterview</div>
										<div class="post-img">
											<a href=""><img src="<?php echo get_template_directory_uri() ?>/images/placeholders/vendor9.jpg" alt=""></a>
										</div>
										<div class="post-content t-sm">
											<a href="" class="post-name">Lorem ipsum dolor sit amet.</a>
										</div>
									</div>
								</div>
								<div class="col-md-4 col-sm-6">
									<div class="post-item well-block" style="border-bottom: 3px solid #32a69f">
										<div class="well-header">Winery</div>
										<div class="post-img">
											<a href=""><img src="<?php echo get_template_directory_uri() ?>/images/placeholders/vendor1.jpg" alt=""></a>
										</div>
										<div class="post-content t-sm">
											<a href="" class="post-name">Lorem ipsum dolor sit amet.</a>
										</div>
									</div>
								</div>
								<div class="col-md-4 col-sm-6">
									<div class="post-item well-block" style="border-bottom: 3px solid #a68432">
										<div class="well-header">Chapel</div>
										<div class="post-img">
											<a href=""><img src="<?php echo get_template_directory_uri() ?>/images/placeholders/vendor2.jpg" alt=""></a>
										</div>
										<div class="post-content t-sm">
											<a href="" class="post-name">Lorem ipsum dolor sit amet.</a>
										</div>
									</div>
								</div>
								<div class="col-md-4 col-sm-6">
									<div class="post-item well-block" style="border-bottom: 3px solid #6032a6">
										<div class="well-header">Waterview</div>
										<div class="post-img">
											<a href=""><img src="<?php echo get_template_directory_uri() ?>/images/placeholders/vendor3.jpg" alt=""></a>
										</div>
										<div class="post-content t-sm">
											<a href="" class="post-name">Lorem ipsum dolor sit amet.</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="pagination">
							<label for="">Pagination :</label>
							<div class="wp-pagenavi"> <span class="pages">Page 1 of 2</span><span class="current">1</span><a class="page larger" href="#">2</a><a class="nextpostslink" rel="next" href="#">Next</a></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<aside class="l-sidebar">
					<div class="widget widget-aside widget-list">
						<div class="widget-header">Venue Categories</div>
						<ul class="list">
							<li><a href="">Chapel</a></li>
							<li><a href="">Garden</a></li>
							<li><a href="">Cruise</a></li>
							<li><a href="">Historic</a></li>
							<li><a href="">Golf Club</a></li>
							<li><a href="">Hotel</a></li>
							<li><a href="">Restaurant</a></li>
							<li><a href="">Function Centre</a></li>
							<li><a href="">Waterview</a></li>
							<li><a href="">Winery</a></li>


						</ul>
					</div>
					<div class="widget widget-aside widget-list">
						<div class="widget-header">Venue Regions</div>
						<ul class="list">
							<li><a href="">The Hills Shire</a></li>
							<li><a href="">Sydney</a></li>
							<li><a href="">Northern Beaches</a></li>
							<li><a href="">Wetherill Park / Campbelltown</a></li>
							<li><a href="">Blue Mountains</a></li>
							<li><a href="">Hunter Valley </a></li>
							<li><a href="">Central Coast</a></li>
							<li><a href="">Wollongong/Sutherland</a></li>
							<li><a href="">Kangaroo Valley </a></li>
							<!-- <li><a href="">Sydney</a></li>
							<li><a href="">Beaches & Water Views, Sydneyt</a></li>
							<li><a href="">North Shore, Sydney</a></li>
							<li><a href="">Northern Beaches, Sydney</a></li>
							<li><a href="">Northern Districts, Sydney</a></li>
							<li><a href="">Parramatta & Western Suburbs</a></li>
							<li><a href="">Southern Districts, Sydney</a></li>
							<li><a href="">Central Coast</a></li>
							<li><a href="">Hunter Valley, Newcastle & Port Stephens</a></li>
							<li><a href="">Mid North Coast</a></li>
							<li><a href="">South Coast & Shoalhaven</a></li>
							<li><a href="">Southern Highlands</a></li>
							<li><a href="">Wollongong</a></li> -->
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
