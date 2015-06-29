<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

<?php get_template_part('page','title'); ?>

<div class="section section-l2">
  <div class="container">
    <div class="row">
 		<div class="col-xs-8">
       
			<?php
				while ( have_posts() ) : the_post();
				if (is_page('properties')) {
					get_template_part( 'loop', 'property' );
				}else{
					get_template_part( 'content', 'page' );
				}
				endwhile;
			?>

		</div>

     	<div class="col-xs-4">
        	<?php get_template_part('sidebar'); ?>
      	</div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
