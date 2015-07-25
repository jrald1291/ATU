<?php

/**

 * Template Name: RSVP Group

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

								  <option value="" selected="selected">Show all Group</option>

								  <?php

									$tax = 'meetup_groups-category';

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



						<div class="grid grid-isotope grid-isotope-md">


							 <?php
                            $args = array(
                                'post_type' => 'meetup_groups',
                                'posts_per_page' => 8,
                                'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
                                'order' => 'DESC',
                                'post_status'  => 'publish'
                            );

                             if (isset($_REQUEST['category']) && !empty($_REQUEST['category'])) {
                                 $args['tax_query'] = array(
                                     array(
                                         'taxonomy' => 'meetup_groups-category',
                                         'field'    => 'slug',
                                         'terms'    => $_REQUEST['category'],
                                     ),
                                 );
                             }

							    $loop = new WP_Query( $args );

							    $today = date('F j, Y');

							    $today = new DateTime($today);

							    $addClass = '';



								    while ( $loop->have_posts() ) : $loop->the_post();

								    	$my_terms = get_the_terms( $post->ID, 'meetup_groups-category' );

										

								    ?>



										<div class="element-item grid-item <?php if( $my_terms && !is_wp_error( $my_terms ) ) {

										    foreach( $my_terms as $term ) {

										        echo $term->slug." ";

										    }

											} ?>">

											<div class="grid-wrap">

												<div class="grid-img">

													<a href="<?php the_field('group_url'); ?>">

														<?php 

															the_post_thumbnail('venue-medium'); 

														?>

													</a>

													<?php





														$date = new DateTime( get_field('date') );

														if ($today>$date) {

															$addClass = 'done';

														}else{

															$addClass = '';

														}

													 ?>

													<div class="grid-title">

														<div class="grid-date <?php echo $addClass; ?>">

															<?php the_field('date'); ?>

														</div>

														<a href="<?php the_field('group_url'); ?>" class="link"><?php the_title(); ?></a>

													</div>

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

								var grid = jQuery('.grid-isotope-md');



								grid.isotope({

						          itemSelector: '.grid-item',

						          layoutMode: 'fitRows',

						          resizable: true, 

						          masonry: { columnWidth: grid.width() / 2 }

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

