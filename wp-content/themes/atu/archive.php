<?php get_header(); ?>

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
						<div class="page-title">
							<h2 class="t-lg"></h2>
						</div>
						<div class="mb-20 xx">
							 <?php while ( have_posts() ) : the_post();?>
							 	<?php if (is_author()) {?>
							 		<?php get_template_part( 'author', 'bio');?>	
							 	<?php } else {?>
							 		<?php get_template_part( 'content', 'page');?>
							 	<?php } ?>
							 <?php endwhile;?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<?php if (is_author()) {?>
			 		<?php get_template_part('sidebar','primary') ?>	
			 	<?php } else {?>
			 		<?php get_template_part('sidebar','secondary') ?>
			 	<?php } ?>
				
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>