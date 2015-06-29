  <?php 
    $paged = get_query_var('paged');
    $args = array( 'post_type' => 'property', 'posts_per_page' => 10,'paged' => $paged, 'order' => 'DESC','post_status'  => 'publish' );
    $loop = new WP_Query( $args );
    while ( $loop->have_posts() ) : $loop->the_post();?>
      <article class="well well-bordered post-property">
        <a href="<?php the_permalink() ?>">
          <div class="row">
            <div class="col-xs-4">
              <div class="post-img well-img well">
                   <?php the_post_thumbnail('img-md') ?>
                  <span class="text-right t-upper"><?php the_field('category'); ?></span>
              </div>
            </div>
            <div class="col-xs-8">
              <div class="post-desc">
                <h3 class="price title t-base2"><?php the_field('price'); ?></h3>
                <h3 class="category title"><?php the_field('complete_address'); ?></h3>
                <p><?php the_subtitle(); ?></p>
                <p><?php echo content(strip_shortcodes(wp_trim_words(get_the_content())),17);?></p>
                <ul class="prop-details">
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
                </ul>
              </div>
            </div>
          </div>
        </a>
      </article>
<?php endwhile; ?>   

<?php wp_pagenavi( array( 'query' => $loop ) ); ?>
<?php wp_reset_postdata(); ?>