<?php
/**
 *  Get the category
 * @var  $cat_name */
$cat_name = get_the_title();
$cats = get_the_terms( get_the_ID(), 'venue-category' );
if ( ! empty( $cats ) ) {
    $cat_name = $cats[0]->name;
}
?>

<div class="col-md-4 col-sm-6">
    <div class="post-item well-block" style="border-bottom: 3px solid <?php the_field( 'color' ); ?>">
        <div class="well-header"><?php echo $cat_name; ?></div>
        <div class="post-img">
            <a href="<?php the_permalink(); ?>"><?php do_action('aut_post_thumnail', 'venue-listing'); ?></a>
        </div>
        <div class="post-content t-sm marquee">
            <a href="<?php the_permalink(); ?>" class="post-name"><?php the_title(); ?></a>
        </div>
    </div>
</div>
