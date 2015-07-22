<?php
/**
 * We start by doing a query to retrieve all users
 * We need a total user count so that we can calculate how many pages there are
 */
?>



<div class="post post-block">
    <div class="row">

        <?php if ( have_posts() ) : ?>

            <?php



            // Start the Loop.
            while ( have_posts() ) : the_post();

                $user_id = get_post_meta( get_the_ID(), 'vendor', true );

               // if ( WEPN_Helper::check_user_role( 'vendor', $user_id ) ) {

                    $cat_name = get_the_title();


                    $taxonomy = get_user_meta($user_id, 'city', true);
                    $cats = get_the_terms(get_the_ID(), $taxonomy);

                    if (!empty($cats) && !is_wp_error($cats)) $cat_name = $cats[0]->name;


                    $image_id = get_user_meta($user_id, 'profile_image', true);
                    ?>

                    <div class="col-md-4 col-sm-6">
                        <div class="post-item well-block"
                             style="border-bottom: 3px solid <?php echo hex2rgba(get_field('color')); ?>">
                            <div class="well-header">
                                <div class="marquee"><span><?php echo $cat_name; ?></span></div>
                            </div>
                            <div class="post-img">
                                <a href="<?php the_permalink(); ?>"><?php echo wp_get_attachment_image($image_id, 'img-avatar'); ?></a>
                            </div>
                            <div class="post-content t-sm marquee">
                                <a href="<?php the_permalink(); ?>" class="post-name"><?php the_title(); ?></a>
                            </div>
                        </div>
                    </div>


                    <?php
//                } else {
//                    wp_delete_post( get_the_ID(), true );
//                }

                // End the loop.
            endwhile;

        // If no content, include the "No posts found" template.
        else :
            get_template_part( 'content', 'none' );

        endif;
        ?>
    </div>
</div>
<?php

global $wp_query;

WEPN_Helper::wepn_pagination($wp_query->max_num_pages); ?>


