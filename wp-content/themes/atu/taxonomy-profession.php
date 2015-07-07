<?php

get_header(); ?>


<div class="l-content-bg" style="background: url('<?php ATU_Helper::background_image( get_field('page_background', get_the_ID()) ); ?>') no-repeat">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="l-content-container">
                    <div class="page-header">
                        <form action="" class="form">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control input-block" placeholder="Keyword...">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="input-group">
                                        <div class="input-group-addon">Venue Category</div>
                                        <select class="form-control input-block" name="" id="">
                                            <option value="">test</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-secondary btn-block" ><span class="fa fa-search icon-l"></span>Search Venue</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="page-content">
                        <div class="post post-block">
                            <div class="row">

                                <?php
                                /**
                                 * We start by doing a query to retrieve all users
                                 * We need a total user count so that we can calculate how many pages there are
                                 */

                                $count_args  = array(
                                    'role'      => 'Vendor',
                                    'fields'    => 'all_with_meta',
                                    'meta_query' => array(
                                        'relation'  => 'OR',
                                        array(
                                            'key'       => 'profession',
                                            'value'     => get_query_var( 'term' ),
                                            'compare'   => '='
                                        )
                                    ),
                                    'number'    => 999999
                                );
                                $user_count_query = new WP_User_Query($count_args);
                                $user_count = $user_count_query->get_results();

                                // count the number of users found in the query
                                $total_users = $user_count ? count($user_count) : 1;

                                // grab the current page number and set to 1 if no page number is set
                                $page = get_query_var( 'page' ) ? get_query_var( 'page' ) : 1;

                                // how many users to show per page
                                $users_per_page = 12;

                                // calculate the total number of pages.
                                $total_pages = 1;
                                $offset = $users_per_page * ($page - 1);
                                $total_pages = ceil($total_users / $users_per_page);


                                /**
                                 * WP Query users
                                 * @var  $vendors */
                                $args  = array(
                                    // search only for Authors role
                                    'role'      => 'Vendor',
                                    // order results by display_name
                                    'orderby'   => 'display_name',
                                    // return all fields
                                    'fields'    => 'all_with_meta',
                                    'meta_query' => array(
                                        'relation'  => 'OR',
                                        array(
                                            'key'       => 'profession',
                                            'value'     => get_query_var( 'term' ),
                                            'compare'   => '='
                                        )
                                    ),
                                    'number'    => $users_per_page,
                                    'offset'    => $offset // skip the number of users that we have per page

                                );

                                $wp_user_query = new WP_User_Query( $args );

                                // Get the results
                                $vendors = $wp_user_query->get_results();

                                if ( ! empty( $vendors ) ) :
                                    foreach( $vendors as $vendor ):
                                        $vendor_info = get_userdata($vendor->ID);

                                        $profession = '';
                                        $categories = wp_get_object_terms( $vendor->ID, 'profession', false );

                                        $image_id = get_user_meta( $vendor->ID, 'profile_image', true );

                                        if ( !empty( $categories ) ) $profession = $categories[0]->name;


                                        ?>

                                        <div class="col-md-4 col-sm-6">
                                            <div class="post-item well-block" style="border-bottom: 3px solid <?php echo $vendor_info->color; ?>">
                                                <div class="well-header"><?php echo $profession; ?></div>
                                                <div class="post-img">
                                                    <a href="/vendor/<?php echo $vendor->user_login; ?>">
                                                        <?php echo wp_get_attachment_image( $image_id, 'vendor-small-thumb' ); ?>
                                                    </a>
                                                </div>
                                                <div class="post-content t-sm">
                                                    <a href="/vendor/<?php echo $vendor->user_login; ?>" class="post-name">
                                                        <?php echo $vendor_info->first_name .' '. $vendor_info->last_name; ?>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach;
                                else: ?>

                                    <h2><?php _e( 'No vendors found', 'atu'); ?></h2>

                                <?php endif; ?>
                            </div>
                        </div>

                        <?php
                        $current_url = get_permalink( get_page_by_path( 'vendors' ) );
                        $next = $page < $total_pages ? $page + 1 : $page;

                        echo '<div class="pagination">';
                        echo '<label for="">Pagination :</label>';
                        echo '<div class="wp-pagenavi">';
                        echo '<span class="pages">Page '. $page .' of '. $total_pages .'</span>';

                        for( $i = 1; $i <= $total_pages; $i++ ) {
                            if ( $i == $page ) {
                                echo '<span class="current">'. $page .'</span>';

                            } else {

                                echo '<a class="page larger" href="'. $current_url . $i .'/">'. $i .'</a>';
                            }
                        }


                        echo '<a class="nextpostslink" rel="next" href="'. $current_url . $next .'/">Next</a>';
                        echo '</div>';
                        echo '</div>';

                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <aside class="l-sidebar">
                    <div class="widget widget-aside widget-list">
                        <div class="widget-header">Vendor Categories</div>
                        <?php ATU_Helper::list_vendor_category(); ?>
                    </div>
                    <div class="widget widget-aside well-widget">
                        <form action="" class="form form-labeled">
                            <div class="well-header">Subscribe to our Newsletter</div>
                            <div class="form-group field-wrap">
                                <label for="">Email Address</label>
                                <input type="text" class="form-control">
                            </div>
                            <button class="btn btn-primary btn-block">Subscribe now</button>
                        </form>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
<script>
    new CBPGridGallery( document.getElementById( 'grid-gallery' ) );
</script>