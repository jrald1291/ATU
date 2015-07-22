<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="page-title ">
		<h1 class="t-lg"><?php the_title(); ?></h1>
		</div>
		<?php if ( has_post_thumbnail() ) { ?>
			<div class="post-img well-img mb-20">
				<?php the_post_thumbnail('img-wide'); ?>
			</div>
		<?php } ?>
		<div class="post-core">
		<div class="post-content copy mb-30">
			<div class="row">
				<div class="col-md-6">
					<?php if (of_get_option('video_about', '')) {?>
						<?php echo of_get_option('video_about', ''); ?>
						<h3 class="t-title mt-10 text-center"><?php echo of_get_option('video_about_text', ''); ?></h3>
					<?php } ?>
				</div>
				<div class="col-md-6">
					<?php if (of_get_option('video_blooper', '')) {?>
						<?php echo of_get_option('video_blooper', ''); ?>
						<h3 class="t-title mt-10 text-center"><?php echo of_get_option('video_blooper_text', ''); ?></h3>
					<?php } ?>
				</div>
			</div>
			<p><?php the_content(); ?></p>
		</div>
		<div class="post post-block">
			<div class="row">
				<?php 
					if( have_rows('member') ):
					    while ( have_rows('member') ) : the_row();?>

							<div class="col-md-4 col-sm-6">
								<div class="post-item">
									<div class="post-header"><?php the_sub_field('member_name'); ?></div>
									<div class="post-img">
										<?php $member_img = wp_get_attachment_image_src(get_sub_field('member_image'),'img-avatar'); ?>
										<img src="<?php echo $member_img[0];?>"/>
									</div>
									<div class="post-content t-sm">
										<?php the_sub_field('member_title'); ?>
										<span><?php the_sub_field('member_sub_title'); ?></span>
									</div>
								</div>
							</div>

					    <?php endwhile;?>
				<?php endif;?>
				<?php wp_reset_query(); ?>
				
				
			</div>
		</div>
	</div>
</article>



