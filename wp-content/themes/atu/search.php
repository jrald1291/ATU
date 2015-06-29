<?php get_header(); ?>

<?php get_template_part('page','title'); ?>
<div class="section section-l2">
	<div class="container">
		<div class="row">
		    <div class="col-xs-8">

		      	<?php
					if (isset($_GET['post_type'])) {
						$post_type = $_GET['post_type'];
					}
					
					if ($post_type) {
						get_template_part( 'search', $post_type );
					}
					else{ ?>

						<?php if ( have_posts() ) :
						  	get_template_part( 'content', 'search' );
					  	else :
							get_template_part( 'content', 'none' );
						endif;?>

					<?php } ?>

			</div>
	        <div class="col-xs-4">
	        	<?php get_template_part('sidebar'); ?>
	        </div>
    	</div>
  	</div>
</div>
<?php get_footer(); ?>

