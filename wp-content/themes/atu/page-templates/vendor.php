<?php
/**
 * Template Name: Vendor
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
if ( ! is_user_logged_in() ) {
    exit( wp_redirect( wp_login_url() ) );
}
get_header();




$current_user = wp_get_current_user();

$user_info = get_user_meta( $current_user->ID );


?>

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
						<div class="page-title ">
							<h2 class="t-lg">Inspired By Happiness</h2>
						</div>
						<div class="slider mb-20">
							<div class="slider-single slider-capt flexslider mb-0">
							  <ul class="slides">
							    <li>
							    	<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/slide-single.jpg" alt=""> 						
							    </li>	
							    <li>
							    	<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/slide-single.jpg" alt=""> 						
							    </li>
							    <li>
							    	<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/slide-single.jpg" alt=""> 						
							    </li>						 
							  </ul>

							</div>
						</div>
						<div class="section section-tabbed">
							  <ul class="nav nav-tabs" role="tablist">
							    <li role="presentation" class="active"><a href="#description" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
							    <li role="presentation"><a href="#gallery" aria-controls="gallery" role="tab" data-toggle="tab">Gallery</a></li>
							    <li role="presentation"><a href="#youtube" aria-controls="youtube" role="tab" data-toggle="tab">Youtube Video</a></li>
							    <li role="presentation"><a href="#offers" aria-controls="offers" role="tab" data-toggle="tab">Special Offer</a></li>
							  </ul>
							  <div class="tab-content">
							    <div role="tabpanel" class="tab-pane active copy" id="description">
									<?php echo $current_user->description ?>
							    </div>
							    <div role="tabpanel" class="tab-pane" id="gallery">
							    	<div id="grid-gallery" class="grid-gallery">
										<section class="grid-wrap">
											<ul class="grid">
												<li class="grid-sizer"></li><!-- for Masonry column width -->
												<li>
													<figure>
														<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/gallery1.jpg" alt="img01"/>
													</figure>
												</li>
												<li>
													<figure>
														<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/gallery2.jpg" alt="img02"/>
													</figure>
												</li>
												<li>
													<figure>
														<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/gallery3.jpg" alt="img03"/>
													</figure>
												</li>
												<li>
													<figure>
														<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/gallery4.jpg" alt="img04"/>
													</figure>
												</li>
												<li>
													<figure>
														<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/gallery5.jpg" alt="img05"/>
													</figure>
												</li>
												<li>
													<figure>
														<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/gallery6.jpg" alt="img06"/>
													</figure>
												</li>
											</ul>
										</section><!-- // grid-wrap -->
										<section class="slideshow">
											<ul>
												<li>
													<figure>
														<figcaption>
															<h3>Letterpress asymmetrical</h3>
															<p>Kale chips lomo biodiesel stumptown Godard Tumblr, mustache sriracha tattooed cray aute slow-carb placeat delectus. Letterpress asymmetrical fanny pack art party est pour-over skateboard anim quis, ullamco craft beer.</p>
														</figcaption>
														<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/gallery1.jpg" alt="img01"/>
													</figure>
												</li>
												<li>
													<figure>
														<figcaption>
															<h3>Vice velit chia</h3>
															<p>Chillwave Echo Park Etsy organic Cosby sweater seitan authentic pour-over. Occupy wolf selvage bespoke tattooed, cred sustainable Odd Future hashtag butcher.</p>
														</figcaption>
														<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/gallery2.jpg" alt="img02"/>
													</figure>
												</li>
												<li>
													<figure>
														<figcaption>
															<h3>Brunch semiotics</h3>
															<p>IPhone PBR polaroid before they sold out meh you probably haven't heard of them leggings tattooed tote bag, butcher paleo next level single-origin coffee photo booth.</p>
														</figcaption>
														<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/gallery3.jpg" alt="img03"/>
													</figure>
												</li>
												<li>
													<figure>
														<figcaption>
															<h3>Chillwave nihil occupy</h3>
															<p>Vice cliche locavore mumblecore vegan wayfarers asymmetrical letterpress hoodie mustache. Shabby chic lomo polaroid, scenester 8-bit Portland Pitchfork VHS tote bag.</p>
														</figcaption>
														<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/gallery4.jpg" alt="img04"/>
													</figure>
												</li>
												<li>
													<figure>
														<figcaption>
															<h3>Kale chips lomo biodiesel</h3>
															<p>Chambray Schlitz pug YOLO, PBR Tumblr semiotics. Flexitarian YOLO ennui Blue Bottle, forage dreamcatcher chillwave put a bird on it craft beer Etsy.</p>
														</figcaption>
														<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/gallery5.jpg" alt="img05"/>
													</figure>
												</li>
												<li>
													<figure>
														<figcaption>
															<h3>Exercitation occaecat</h3>
															<p>Cosby sweater hella lomo Thundercats VHS occupy High Life. Synth pop-up readymade single-origin coffee, fanny pack tousled retro. Fingerstache mlkshk ugh hashtag, church-key ethnic street art pug yr.</p>
														</figcaption>
														<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/gallery6.jpg" alt="img06"/>
													</figure>
												</li>
											</ul>
											<nav>
												<span class="icon nav-prev"></span>
												<span class="icon nav-next"></span>
												<span class="icon nav-close"></span>
											</nav>
											<div class="info-keys icon">Navigate with arrow keys</div>
										</section><!-- // slideshow -->
									</div><!-- // grid-gallery -->
							    </div>
							    <div role="tabpanel" class="tab-pane" id="youtube">
							    	<iframe width="100%" height="400" src="https://www.youtube.com/embed/9f5maqinuI0" frameborder="0" allowfullscreen></iframe>
							    </div>
							    <div role="tabpanel" class="tab-pane" id="offers">
							    	<ul class="post-inline post-member mb-20">
										<li class="post-item">
											<div class="post-img well-img">
												<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/pdf.jpg" alt="">
											</div>
											<div class="post-core">
												<a href="#" class="link"><div class="post-title t-normal">Kale Biodiesel stumptown Godard Tumblr <span class="post-cat t-highlight">Download PDF</span></div></a>
												<p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse consequat, vel illum dolore eu feugiat nulla facilisis at..</p>
											</div>
										</li>
										<li class="post-item">
											<div class="post-img well-img">
												<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/pdf.jpg" alt="">
											</div>
											<div class="post-core">
												<a href="#" class="link"><div class="post-title t-normal">Duis autem vel eum <span class="post-cat t-highlight">Download PDF</span></div></a>
												<p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse consequat, vel illum dolore eu feugiat nulla facilisis at..</p>
											</div>
										</li>
									</ul>
							    </div>
							  </div>
						</div>
						<div class="social-links list-labeled-inline bt-0">
							<label for="">Follow us in social :</label>
							<ul>
								<li><a href=""><span class="fa fa-instagram"></span></a></li>
								<li><a href=""><span class="fa fa-youtube"></span></a></li>
								<li><a href=""><span class="fa fa-google-plus"></span></a></li>
								<li><a href=""><span class="fa fa-pinterest"></span></a></li>
								<li><a href=""><span class="fa fa-twitter"></span></a></li>
								<li><a href=""><span class="fa fa-linkedin"></span></a></li>
								<li><a href=""><span class="fa fa-facebook"></span></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
<div class="pagination-single">
	<ul>
		<li class="prev">
			<a href="">
				<span class="label"><i class="fa fa-angle-left icon-l"></i>Previous</span>
				<span>Gledswood wedding</span>
			</a>
		</li>
		<li class="back">
			<a href="#">back to vendors listing</a>
		</li>
		<li class="next">
			<a href="">
				<span class="label">Next<i class="fa fa-angle-right icon-r"></i></span>
				<span>Gledswood wedding</span>
			</a>
		</li>
	</ul>
</div>
</div>
<?php get_footer(); ?>
<script>
	 new CBPGridGallery( document.getElementById( 'grid-gallery' ) );
</script>