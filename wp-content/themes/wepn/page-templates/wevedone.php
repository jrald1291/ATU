<?php

/**

 * Template Name: What weve done

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

						 <form id="sort_post" action="<?php echo get_permalink(get_the_ID()); ?>" method="post" class="form">
		                    <div class="form-group">
								<select name="category" class="form-control">

								  <option value="" selected="selected">Show all Category</option>

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

								</select>

				            </div>

				        </form>

					</div>

					<div class="page-content">

						<div class="grid grid-isotope grid-isotope-sm">

							 <?php
							    $args = array(
                                    'post_type'         => 'portfolio',
                                    'posts_per_page'    => 30,
                                    'paged'             => get_query_var('paged') ? get_query_var('paged') : 1,
                                    'order'             => 'DESC',
                                    'post_status'       => 'publish'
                                );

                                if (isset($_REQUEST['category']) && !empty($_REQUEST['category'])) {
                                    $args['tax_query'] = array(
                                        array(
                                            'taxonomy' => 'portfolio-category',
                                            'field'    => 'slug',
                                            'terms'    => $_REQUEST['category'],
                                        ),
                                    );
                                }


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

						<script>

							jQuery( function() {

						        var grid = jQuery('.grid-isotope-sm');

						        

						        grid.isotope({

						          itemSelector: '.grid-item',

						          layoutMode: 'masonry',

						          resizable: true, 

						          masonry: { columnWidth: grid.width() / 3 }

						        });

					        });

						</script>



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

