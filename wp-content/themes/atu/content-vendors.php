<?php
/**
 * We start by doing a query to retrieve all users
 * We need a total user count so that we can calculate how many pages there are
 */

$term = get_query_var( 'term' );

$search_args = array();

$count_args  = array(
    'role'      => 'Vendor',
    'fields'    => 'all_with_meta',
    'number'    => 999999
);

$search_args['meta_query'] = array(
        'relation'  => 'OR'
    );

if ( isset( $_GET['keyword'] ) ) {
    $search_args['search'] = '*'.esc_attr( $_GET['keyword'] ).'*';


    $search_args['meta_query'] += array(
        array(
            'key'     => 'last_name',
            'value'   => $_GET['keyword'],
            'compare' => 'LIKE'
        ),
        array(
            'key'     => 'first_name',
            'value'   => $_GET['keyword'],
            'compare' => 'LIKE'
        ),
        array(
            'key'     => 'company_name',
            'value'   => $_GET['keyword'],
            'compare' => 'LIKE'
        )
    );
}

if(  isset( $_GET['profession'] ) && ! empty( $_GET['profession'] ) ) {


    $search_args['meta_query'] += array(

        array(
            'key'       => 'profession',
            'value'     => esc_attr( $_GET['profession'] ),
            'compare'   => '='
        )

    );
} elseif ( is_archive() ) {
    $search_args['meta_query'] = array(
        array(
            'key'       => 'profession',
            'value'     => $term,
            'compare'   => '='
        )
    );
}


$count_args = array_merge( $count_args, $search_args );



$user_count_query = new WP_User_Query($count_args);
$user_count = $user_count_query->get_results();

// count the number of users found in the query
$total_users = $user_count ? count($user_count) : 1;

// grab the current page number and set to 1 if no page number is set
if  (  get_query_var( 'page' ) ) {
    $page = get_query_var( 'page' );
} elseif ( get_query_var( 'paged' ) ) {
    $page = get_query_var( 'paged' );
} else {
    $page = 1;
}
//$page = get_query_var( 'page' ) ? get_query_var( 'page' ) : 1;

// how many users to show per page

$users_per_page = get_option( 'show_vendors_per_page', 12 );

// calculate the total number of pages.
$total_pages = 1;
$offset = $users_per_page * ($page - 1);
$total_pages = ceil( $total_users / $users_per_page );


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

    'number'    => $users_per_page,
    'offset'    => $offset // skip the number of users that we have per page

);

$args = array_merge( $args, $search_args );


$wp_user_query = new WP_User_Query( $args );

// Get the results
$vendors = $wp_user_query->get_results();

if ( ! empty( $vendors ) ) : ?>
    <div class="post post-block">
        <div class="row">
            <?php foreach( $vendors as $vendor ):
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
                            <a href="<?php echo get_permalink( get_page_by_path( 'vendor' ) ) . $vendor->user_login; ?>">

                                <?php echo wp_get_attachment_image( $image_id, 'img-avatar' ); ?>

                            </a>
                        </div>
                        <div class="post-content t-sm marquee">

                            <a href="<?php echo get_permalink( get_page_by_path( 'vendor' ) ) . $vendor->user_login; ?>" class="post-name">

                                <?php echo $vendor_info->first_name .' '. $vendor_info->last_name; ?>

                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>

    <?php

    /**
     * ATU custom pagination
     * @params $total_pages,
     * @params $page
     */
    ATU_Helper::pagination( $total_pages, $page );

    ?>
<?php else: ?>

    <h2><?php _e( 'No vendors found', 'atu'); ?></h2>

<?php endif; ?>