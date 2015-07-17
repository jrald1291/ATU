<?php
/**
 * Template Name: Contact
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
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
							    $paged = get_query_var('paged');
							    $args = array( 'post_type' => 'post', 'posts_per_page' => 10,'paged' => $paged, 'order' => 'DESC','post_status'  => 'publish' );
							    $loop = new WP_Query( $args );

								    while ( $loop->have_posts() ) : $loop->the_post();

										get_template_part( 'content', get_post_format() );

									endwhile; ?>   

									<div class="pagination">
										<label for="">Pagination :</label>
										<?php wp_pagenavi( array( 'query' => $loop ) ); ?>
									</div>
								<?php wp_reset_postdata(); ?>
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
