<?php
/**
 * Template Name: About
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
							<h2 class="t-lg">Meet the Team</h2>
						</div>
						<div class="copy mb-30">
							<p>We are your one stop wedding and event planning collective of original artisans who are available to manifest your wildest dreams.
							Our vendors are primarily small local businesses with an absolute passion for their profession.
							Our services and products are mostly handmade, custom crafted and delivered with love.
							We regularly work together on tailor made events and have a synergy of trust, understanding and creativity.</p>
						</div>

						<div class="post post-block">
							<div class="row">
								<div class="col-md-4 col-sm-6">
									<div class="post-item">
										<div class="post-header">Jacie Whitfield</div>
										<div class="post-img">
											<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/team1.jpg" alt="">
										</div>
										<div class="post-content t-sm">
											Administration
											<span>BSc Marketing Lorem Ipsum Dolor</span>
										</div>
									</div>
								</div>
								<div class="col-md-4 col-sm-6">
									<div class="post-item">
										<div class="post-header">Jacie Whitfield</div>
										<div class="post-img">
											<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/team2.jpg" alt="">
										</div>
										<div class="post-content t-sm">
											Administration
											<span>BSc Marketing Lorem Ipsum Dolor</span>
										</div>
									</div>
								</div>
								<div class="col-md-4 col-sm-6">
									<div class="post-item">
										<div class="post-header">Jacie Whitfield</div>
										<div class="post-img">
											<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/team3.jpg" alt="">
										</div>
										<div class="post-content t-sm">
											Administration
											<span>BSc Marketing Lorem Ipsum Dolor</span>
										</div>
									</div>
								</div>
								<div class="col-md-4 col-sm-6">
									<div class="post-item">
										<div class="post-header">Jacie Whitfield</div>
										<div class="post-img">
											<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/team4.jpg" alt="">
										</div>
										<div class="post-content t-sm">
											Administration
											<span>BSc Marketing Lorem Ipsum Dolor</span>
										</div>
									</div>
								</div>
								<div class="col-md-4 col-sm-6">
									<div class="post-item">
										<div class="post-header">Jacie Whitfield</div>
										<div class="post-img">
											<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/team5.jpg" alt="">
										</div>
										<div class="post-content t-sm">
											Administration
											<span>BSc Marketing Lorem Ipsum Dolor</span>
										</div>
									</div>
								</div>
								<div class="col-md-4 col-sm-6">
									<div class="post-item">
										<div class="post-header">Jacie Whitfield</div>
										<div class="post-img">
											<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/team6.jpg" alt="">
										</div>
										<div class="post-content t-sm">
											Administration
											<span>BSc Marketing Lorem Ipsum Dolor</span>
										</div>
									</div>
								</div>
							</div>
						</div>

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