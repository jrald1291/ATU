<?php

/**

 * Template Name: Form Page

 *

 * @package WordPress

 * @subpackage Twenty_Fourteen

 * @since Twenty Fourteen 1.0

 */



get_header(); ?>





<div class="l-content-bg" style="background: url('<?php WEPN_Helper::background_image( get_field('page_background', get_the_ID()) ); ?>') no-repeat">

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
			
						<div class="page-title ">

							<h2 class="t-md"><?php the_title(); ?></h2>

						</div>
						 <?php while ( have_posts() ) : the_post();?>
							<?php the_content(); ?>
						 <?php endwhile;?>

					</div>

				</div>

			</div>

			<div class="col-md-3">

				<?php get_template_part('sidebar','secondary') ?>

			</div>

		</div>

	</div>

</div>
<?php 
	$newline = '"<br>"'; 
?>
<?php $thanks_msg =  strval(of_get_option('message_member', '')); ?>

<?php 
	$thanks_msg = addcslashes($thanks_msg,"\\\'\"\n\r");
?>
<script type="text/javascript">
	document.getElementById("thanks_msg").value = "<?php echo $thanks_msg; ?>";
</script>

<?php get_footer(); ?>

