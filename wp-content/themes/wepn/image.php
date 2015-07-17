<?php
/**
 * The template for displaying image attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
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
						<div class="row">
							<div class="col-md-6">
								<a href="<?php echo get_home_url().'/venue/';?>" class="btn btn-secondary btn-block">Find Venue</a>
							</div>
							<div class="col-md-6">
								<a href="<?php echo get_home_url().'/suppliers/';?>" class="btn btn-secondary btn-block">Find Venue</a>
							</div>
						</div>	
					</div>
					<div class="page-content">
						<div class="post-inline post-blog post-member mb-20">
							 <?php
										// Start the loop.
										while ( have_posts() ) : the_post();
									?>

										<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

											<nav id="image-navigation" class="navigation image-navigation">
												<div class="nav-links">
													<div class="nav-previous"><?php previous_image_link( false, __( 'Previous Image', 'twentyfifteen' ) ); ?></div><div class="nav-next"><?php next_image_link( false, __( 'Next Image', 'twentyfifteen' ) ); ?></div>
												</div><!-- .nav-links -->
											</nav><!-- .image-navigation -->

											<header class="entry-header">
												<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
											</header><!-- .entry-header -->

											<div class="entry-content">

												<div class="entry-attachment">
													<?php
														/**
														 * Filter the default Twenty Fifteen image attachment size.
														 *
														 * @since Twenty Fifteen 1.0
														 *
														 * @param string $image_size Image size. Default 'large'.
														 */
														$image_size = apply_filters( 'twentyfifteen_attachment_size', 'large' );

														echo wp_get_attachment_image( get_the_ID(), $image_size );
													?>

													<?php if ( has_excerpt() ) : ?>
														<div class="entry-caption">
															<?php the_excerpt(); ?>
														</div><!-- .entry-caption -->
													<?php endif; ?>

												</div><!-- .entry-attachment -->

												<?php
													the_content();
													wp_link_pages( array(
														'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfifteen' ) . '</span>',
														'after'       => '</div>',
														'link_before' => '<span>',
														'link_after'  => '</span>',
														'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>%',
														'separator'   => '<span class="screen-reader-text">, </span>',
													) );
												?>
											</div><!-- .entry-content -->

											<footer class="entry-footer">
												<?php twentyfifteen_entry_meta(); ?>
												<?php edit_post_link( __( 'Edit', 'twentyfifteen' ), '<span class="edit-link">', '</span>' ); ?>
											</footer><!-- .entry-footer -->

										</article><!-- #post-## -->

										<?php
											// If comments are open or we have at least one comment, load up the comment template
											if ( comments_open() || get_comments_number() ) :
												comments_template();
											endif;

											// Previous/next post navigation.
											the_post_navigation( array(
												'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'twentyfifteen' ),
											) );

										// End the loop.
										endwhile;
									?>
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
