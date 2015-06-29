<?php get_header(); ?>

<?php get_template_part('page','title'); ?>

<div class="section section-l2">
  <div class="container">
    <div class="row">
      <div class="col-xs-8">
        <div class="title title-l1">
			<div class="row">
				<div class="col-xs-7">
					<h1 class="title"><strong><?php the_title(); ?></strong></h1>
				</div>
				<div class="col-xs-5 text-right">
					<h4 class="title t-base2"><strong><?php the_field('price'); ?></strong></h4>
				</div>
			</div>
        </div>
        <div class="well well-bordered mb-0">
        	<div class="slider-single flexslider">
			  <ul class="slides">
			    <?php 
					if( have_rows('image_slider') ):
					    while ( have_rows('image_slider') ) : the_row();
					        $slider = wp_get_attachment_image_src(get_sub_field('property_images'),'single');?>
							<li> <img src="<?php echo $slider[0]; ?>" /> </li>

					    <?php endwhile;
						else :?>
						<p>no property under this category</p>
					<?php endif;?>
					<?php wp_reset_query(); ?>
			  </ul>

			</div>
			<div id="carousel-single" class="flexslider">
			 <ul class="slides">
			    <?php 
					if( have_rows('image_slider') ):
					    while ( have_rows('image_slider') ) : the_row();
					        $slider = wp_get_attachment_image_src(get_sub_field('property_images'),'small');?>
							<li> <img src="<?php echo $slider[0]; ?>" /> </li>

					    <?php endwhile;
						else :?>
						<p>no property under this category</p>
					<?php endif;?>
					<?php wp_reset_query(); ?>
			  </ul>

			</div>
			<div class="prop-content">

				<ul class="prop-details well-gray well">
					<?php if (get_field('land_area')): ?>
						<li><span class="icon-prop icon-la"></span>LA: <?php the_field('land_area'); ?></li>
					<?php endif ?>
					<?php if (get_field('floor_area')): ?>
						<li><span class="icon-prop icon-fa"></span>FA: <?php the_field('floor_area'); ?></li>
					<?php endif ?>
					<?php if (get_field('beds')): ?>
						<li><span class="icon-prop icon-bed"></span><?php the_field('beds'); ?></li>
					<?php endif ?>
					<?php if (get_field('baths')): ?>
						<li><span class="icon-prop icon-bath"></span><?php the_field('baths'); ?></li>
					<?php endif ?>
					<?php if (get_field('garage')): ?>
						<li><span class="icon-prop icon-car"></span><?php the_field('garage'); ?></li>
					<?php endif ?>
						<li><span class="icon-prop icon-star"></span><?php the_field('category'); ?></li>
				</ul>
				<div class="prop-content-core">
					<p><?php the_subtitle(); ?></p>
					<ul class="list-details">
				    <?php 
						if( have_rows('property_details_list') ):
						    while ( have_rows('property_details_list') ) : the_row();?>
								<li> <?php the_sub_field('item'); ?> </li>
						    <?php endwhile;?>
						<?php endif;?>
						<?php wp_reset_query(); ?>
				  	</ul>
					<?php the_content(); ?>
				</div>
			</div>

        </div>
        <div class="post-share mb-30">	
			<span>Share this: </span>
			<script charset="utf-8" type="text/javascript">var switchTo5x=true;</script>
			<script charset="utf-8" type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
			<script charset="utf-8" type="text/javascript">stLight.options({"publisher":"a99f63c5-2c67-407e-9eed-9b49993e532f"});var st_type="wordpress4.1.1";</script>
			<span class='st_facebook_hcount' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'></span>
			<span class='st_fblike_hcount' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'></span>
			<span class='st_plusone_hcount' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'></span>
			<span class='st_email_hcount' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'></span>
		</div>
        <div class="fb-comments" data-href="<?php echo current_page_url(); ?>" data-width="100%" data-numposts="10" data-colorscheme="light"></div>
      </div>
      <div class="col-xs-4">
        <?php get_template_part('sidebar'); ?>
      </div>
    </div>
  </div>
</div>




<?php get_footer(); ?>
