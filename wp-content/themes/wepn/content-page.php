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
		<div class="post-content copy">
			<p><?php the_content(); ?></p>
		</div>
	</div>
</article>



