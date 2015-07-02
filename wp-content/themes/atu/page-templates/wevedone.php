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
								<button class="btn btn-secondary btn-block" data-toggle="modal" data-target=".form-venue">Search Venue</button>
							</div>
							<div class="col-md-6">
								<button class="btn btn-secondary btn-block" data-toggle="modal" data-target=".form-vendor">Search Vendor</button>
							</div>
						</div>	
					</div>
					<div class="page-content">
						<div class="grid-filter">
						    <button class="button btn" data-filter="*">show all</button>
						    <button class="button btn" data-filter=".weddings">Weddings</button>
						    <button class="button btn" data-filter=".ceremonies">Ceremonies</button>
						    <button class="button btn" data-filter=".reception">Reception</button>
						    <button class="button btn" data-filter=".other">Other Events</button>
						</div>
						<div class="grid grid-isotope">
							<div class="element-item grid-item weddings">
								<div class="grid-wrap">
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
							<div class="element-item grid-item ceremonies">
								<div class="grid-wrap">
									<div class="grid-img">
										<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/iso2.jpg" alt="">
										<div class="grid-title">
											Jane quarta decima
										</div>
									</div>	
									<div class="grid-content">
										<p>Lorem ipsum dolor sit amet, consectetuer adipiscing ...</p>
									</div>
								</div>
							</div>
							<div class="element-item grid-item ceremonies">
								<div class="grid-wrap">
									<div class="grid-img">
										<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/iso3.jpg" alt="">
										<div class="grid-title">
											Jane quarta decima
										</div>
									</div>	
									<div class="grid-content">
										<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam.....</p>
									</div>
								</div>
							</div>
							<div class="element-item grid-item ceremonies">
								<div class="grid-wrap">
									<div class="grid-img">
										<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/iso4.jpg" alt="">
										<div class="grid-title">
											Jane quarta decima
										</div>
									</div>	
									<div class="grid-content">
										<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet... </p>
									</div>
								</div>
							</div>
							<div class="element-item grid-item ceremonies">
								<div class="grid-wrap">
									<div class="grid-img">
										<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/iso5.jpg" alt="">
										<div class="grid-title">
											Jane quarta decima
										</div>
									</div>	
									<div class="grid-content">
										<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet... </p>
									</div>
								</div>
							</div>
							<div class="element-item grid-item ceremonies">
								<div class="grid-wrap">
									<div class="grid-img">
										<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/iso6.jpg" alt="">
										<div class="grid-title">
											Jane quarta decima
										</div>
									</div>	
									<div class="grid-content">
										<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam tincidunt ut laoreet dolore magna aliquam erat volutpat. </p>
										<p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit.</p>
									</div>
								</div>
							</div>
							<div class="element-item grid-item ceremonies">
								<div class="grid-wrap">
									<div class="grid-img">
										<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/iso7.jpg" alt="">
										<div class="grid-title">
											Jane quarta decima
										</div>
									</div>	
									<div class="grid-content">
										<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet... </p>
									</div>
								</div>
							</div>
							<div class="element-item grid-item ceremonies">
								<div class="grid-wrap">
									<div class="grid-img">
										<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/iso8.jpg" alt="">
										<div class="grid-title">
											Jane quarta decima
										</div>
									</div>	
									<div class="grid-content">
										<p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper...</p>
									</div>
								</div>
							</div>
							<div class="element-item grid-item ceremonies">
								<div class="grid-wrap">
									<div class="grid-img">
										<img src="<?php echo get_template_directory_uri() ?>/images/placeholders/iso9.jpg" alt="">
										<div class="grid-title">
											Jane quarta decima
										</div>
									</div>	
									<div class="grid-content">
										<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim...</p>
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