<?php
/**
 * Template Name: What weve done
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

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
								<a href="<?php echo get_home_url().'/venue/';?>" class="btn btn-secondary btn-block">Find Venue</a>
							</div>
							<div class="col-md-6">
								<a href="<?php echo get_home_url().'/suppliers/';?>" class="btn btn-secondary btn-block">Find Supplier</a>
							</div>
						</div>	
					</div>
					<div class="page-content">
						<div class="grid-filter">
						    <button class="button btn" data-filter="*">show all</button>
						    
						    <?php
							$tax = 'portfolio-category';
							$terms = get_terms( $tax, $args = array(
							  'hide_empty' => false, 
							));

							foreach( $terms as $term ) {
							    $term_link = get_term_link( $term );

							    if( $term->count > 0 )?>
									<button class="button btn" data-filter=".<?php echo $term->slug ?>"><?php echo $term->name ?></button>
							<?php } ?>
						</div>
						<!-- <select class="filters-select">
							  <?php
								$tax = 'portfolio-category';
								$terms = get_terms( $tax, $args = array(
								  'hide_empty' => false, 
								));
							  foreach( $terms as $term ) {
							    $term_link = get_term_link( $term );

							    if( $term->count > 0 )?>
									<option value=".<?php echo $term->slug ?>"><?php echo $term->name ?></option>
							<?php } ?>
						</select> -->
						<div class="grid grid-isotope">

							 <?php 
							    $paged = get_query_var('paged');
							    $args = array( 'post_type' => 'portfolio', 'posts_per_page' => 30,'paged' => $paged, 'order' => 'DESC','post_status'  => 'publish' );
							    $loop = new WP_Query( $args );

								    while ( $loop->have_posts() ) : $loop->the_post();
								    	$my_terms = get_the_terms( $post->ID, 'portfolio-category' );
										
								    ?>

										<div class="element-item grid-item <?php if( $my_terms && !is_wp_error( $my_terms ) ) {
										    foreach( $my_terms as $term ) {
										        echo $term->slug." ";
										    }
											} ?>">
											<div class="grid-wrap">
												<div class="grid-img">
													<?php the_post_thumbnail('medium'); ?>
													<div class="grid-title">
														<?php the_title(); ?>
													</div>
												</div>	
												<div class="grid-content">
													<?php the_content(); ?>
												</div>
											</div>
										</div>

								<?php endwhile; ?>   
								
								<?php wp_reset_postdata(); ?>
						</div>
						<div class="pagination">
							<label for="">Pagination :</label>
							<?php wp_pagenavi( array( 'query' => $loop ) ); ?>
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
