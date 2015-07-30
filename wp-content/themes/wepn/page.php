<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */


get_header(); ?>

<div class="l-content-bg" style="background: url('<?php WEPN_Helper::background_image( get_field( 'page_background', get_the_ID() ) ); ?>') no-repeat">
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<div class="l-content-container">
					<div class="page-header">
						<div class="row">
							<div class="col-md-6">
								<a href="<?php echo get_home_url().'/venue/';?>" class="btn btn-secondary btn-block">Find Venue</a>
							</div>
							<div class="col-md-6">
								<a href="<?php echo get_home_url().'/suppliers/';?>" class="btn btn-secondary btn-block">Find Supplier</a>
							</div>
						</div>	
					</div>
					<div class="page-content">
						<div class="page-title">
							<h2 class="t-lg"></h2>
						</div>
						<div class="mb-20">
							 <?php while ( have_posts() ) : the_post();?>
							 	<?php if (is_page("meet-the-team")) {?>
							 		<?php get_template_part( 'content', 'about');?>
							 	<?php } else if (is_page("meet-the-team")) {?>
							 		<?php get_template_part( 'content', 'about');?>	
							 	<?php } else {?>
							 		<?php get_template_part( 'content', 'page');?>
							 	<?php } ?>
							 <?php endwhile;?>
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