<?php 

  if (isset($_GET['s'])) {
    $keyword = $_GET['s'];
  }else{
    $keyword = '';
  }
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

 $q1 = get_posts(array(
        'post_type' => 'property',
        's' => $keyword,
        'paged' => $paged, 
));

$q2 = get_posts(array(
        'post_type' => 'property',
        'paged' => $paged,
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key' => 'price',
                'value' => $keyword,
                'compare' => 'LIKE'
            ),
            array(
              'key' => 'category',
              'value' => $keyword,
              'compare' => 'LIKE'
            ),
            array(
              'key' => 'complete_address',
              'value' => $keyword,
              'compare' => 'LIKE'
          ),
         )
));

$merged = array_merge( $q1, $q2 );

$post_ids = array();
foreach( $merged as $item ) {
    $post_ids[] = $item->ID;
}

$unique = array_unique($post_ids);

$posts = get_posts(array(
    'post_type' => 'property',
    'post__in' => $unique,
    'posts_per_page' => 1,
    'paged' => $paged,
    'order' => 'DESC',
    'post_status'  => 'publish',
));
if( $posts ) : foreach( $posts as $post ) :
     setup_postdata($post);?>
        
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
                  <p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem</p>
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
<?php endforeach; endif;  ?> 
<?php wp_reset_postdata(); ?>
<?php wp_pagenavi(); ?>  
<?php wp_reset_postdata(); ?>
