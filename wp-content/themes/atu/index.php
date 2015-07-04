<?php
/**
 * Template Name: Contact
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
