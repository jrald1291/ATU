<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>
<?php if (is_single()) {?>

	<article id="post-<?php the_ID(); ?>" <?php post_class("post-single"); ?>>
		<div class="page-title ">
			<h1 class="t-lg"><?php the_title(); ?></h1>
			<div class="post-meta"><div class="meta date"><?php the_date(); ?></div> <div class="meta author t-upper"><?php the_author(); ?></div></div>
		</div>
		<?php if ( has_post_thumbnail() ) { ?>
			<div class="post-img well-img mb-20">
				<?php the_post_thumbnail('img-wide'); ?>
			</div>
		<?php } ?>
		<div class="post-core">
			<div class="post-content copy">
				<p><?php the_content(); ?></p>
			</div>
		</div>
	</article>
	<div class="social-links list-labeled-inline mb-20">
		<label for="">Follow us in social :</label>
		<ul>

			<?php if (of_get_option('instagram', '')) {?>
				<li><a href="<?php echo of_get_option('instagram', ''); ?>"><span class="fa fa-instagram"></span></a></li>
			<?php } ?>
			<?php if (of_get_option('youtube', '')) {?>
				<li><a href="<?php echo of_get_option('youtube', ''); ?>"><span class="fa fa-youtube"></span></a></li>
			<?php } ?>
			<?php if (of_get_option('google', '')) {?>
				<li><a href="<?php echo of_get_option('google', ''); ?>"><span class="fa fa-google-plus"></span></a></li>
			<?php } ?>
			<?php if (of_get_option('pinterest', '')) {?>
				<li><a href="<?php echo of_get_option('pinterest', ''); ?>"><span class="fa fa-pinterest"></span></a></li>
			<?php } ?>
			<?php if (of_get_option('twitter', '')) {?>
				<li><a href="<?php echo of_get_option('twitter', ''); ?>"><span class="fa fa-twitter"></span></a></li>
			<?php } ?>
			<?php if (of_get_option('linkedin', '')) {?>
				<li><a href="<?php echo of_get_option('linkedin', ''); ?>"><span class="fa fa-linkedin"></span></a></li>
			<?php } ?>
			<?php if (of_get_option('facebook', '')) {?>
				<li><a href="<?php echo of_get_option('facebook', ''); ?>"><span class="fa fa-facebook"></span></a></li>
			<?php } ?>
		</ul>
	</div>
	<div class="fb-comments" data-href="<?php echo current_page_url(); ?>" data-width="100%" data-numposts="10" data-colorscheme="light"></div>

<?php }else{?>
	<article id="post-<?php the_ID(); ?>" <?php post_class("post-item"); ?>>
		<div class="post-img well-img">
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
		</div>
		<div class="post-core">
			<div class="post-title t-normal"><a href="<?php the_permalink(); ?>" class="link"><?php the_title(); ?></a></div>
			<div class="post-meta"><div class="meta date"><?php the_date(); ?></div> <div class="meta author t-upper"><?php the_author(); ?></div></div>
			<div class="post-content">
				<p><?php echo content(strip_shortcodes(wp_trim_words(get_the_content())),25) ?> <a href="<?php the_permalink(); ?>">read more</a></p>
			</div>
		</div>
	</article>
<?php } ?>

