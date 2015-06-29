<?php get_header(); ?>

<?php get_template_part('page','title'); ?>

<div class="section section-l2">
  <div class="container">
    <div class="row">
      <div class="col-xs-8">
      <?php if ( have_posts() ) : ?>

			<?php
			// Start the Loop.
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				if (get_post_type()=='property') {
					get_template_part( 'content', 'property' );
				}else{
					get_template_part( 'content', get_post_format() );
				}
				

			// End the loop.
			endwhile;

			// Previous/next page navigation.
			wp_pagenavi();

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );

		endif;
		?>

      </div>
      <div class="col-xs-4">
        <?php get_template_part('sidebar'); ?>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
