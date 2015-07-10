<?php
/**
 * We start by doing a query to retrieve all users
 * We need a total user count so that we can calculate how many pages there are
 */


add_action( 'pre_user_query', 'extended_user_search' );

function extended_user_search( $user_query ){
    global $wpdb;

    $user_query->query_where = 'WHERE 1=1 ';//. $user_query->get_search_sql( 'venue', array( 'Mz.meta_value' ), 'both' );;

    if ( isset( $_GET['keyword'] ) && ! empty( $_GET['keyword'] ) ) {
        $search = $_GET['keyword'];

        $user_query->query_from .= " JOIN {$wpdb->usermeta} MF ON MF.user_id = {$wpdb->users}.ID AND MF.meta_key = 'first_name'";
        $user_query->query_from .= " JOIN {$wpdb->usermeta} ML ON ML.user_id = {$wpdb->users}.ID AND ML.meta_key = 'last_name'";
        $user_query->query_from .= " JOIN {$wpdb->usermeta} MX ON MX.user_id = {$wpdb->users}.ID AND MX.meta_key = 'company_name'";



        $user_query->query_where .= ' ' . $user_query->get_search_sql( $search, array( 'user_login', 'user_email', 'user_nicename', 'MF.meta_value', 'ML.meta_value', 'MX.meta_value' ), 'both' );



    }

    if ( isset( $_GET['profession'] ) && ! empty( $_GET['profession'] ) ){
        $user_query->query_from .= " JOIN {$wpdb->usermeta} MY ON MY.user_id = {$wpdb->users}.ID AND MY.meta_key = 'profession'";
        $user_query->query_where .= ' ' . $user_query->get_search_sql( esc_attr( $_GET['profession'] ), array( 'MY.meta_value' ), false );

    } elseif (  is_archive() ) {
        $user_query->query_where .= "  AND meta_key = 'profession'";
        $user_query->query_where .= ' ' . $user_query->get_search_sql( esc_attr( get_query_var( 'term' ) ), array( 'meta_value' ), false );
    }
}



$search_args = array();

$count_args  = array(
    'role'      => 'Vendor',
    'fields'    => 'all_with_meta',
    'number'    => 999999
);




$user_count_query = new WP_User_Query($count_args);
//echo '<pre>';
//print_r( $user_count_query );

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

//$args = array_merge( $args, $search_args );


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



