<?php
/**
 * Plugin Name: All Tied Up
 * Description: All Tied up
 * Plugin URI: http://www.alltiedup.com
 * Author: Sergio D. Casquejo
 * Author URI: http://casquejs.freevar.com
 * Version: 1.0
 * Text Domain: wepn
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
//error_reporting(0);





class WEPN {
    var $wepn_db_version = '1.0';

    function __construct() {
        $this->define_constant();
        $this->init_hooks();
        $this->includes();

    }

    function wpse28782_remove_menu_items() {
        if( !current_user_can( 'administrator' ) ):
            remove_menu_page( 'edit.php?post_type=meetup_groups' );
            remove_menu_page( 'edit.php?post_type=portfolio' );
            remove_menu_page( 'tools.php' );
            remove_menu_page('edit-comments.php');
            remove_menu_page('upload.php'); // Media
            remove_menu_page('wpcf7');

        endif;
    }


    function wepn_theme_setup() {
        add_image_size( 'bg-large', 1500, 1000, true ); // (cropped)
        add_image_size( 'gallery-thumb', 186, 186, true ); // (cropped)
        add_image_size( 'venue-medium', 553, 372, true ); // (cropped)
        add_image_size( 'venue-small-thumb', 110, 75, true ); // (cropped)
        add_image_size( 'venue-xs-small-thumb', 60, 60, true ); // (cropped)
        add_image_size( 'vendor-small-thumb', 110, 105, true ); // (cropped)
    }


    function enqueue_scripts() {
        wp_enqueue_style( 'wepn-css', WEPN_ASSETS_URL . 'css/wepn.css' );
        wp_enqueue_script( 'wepn-js', WEPN_ASSETS_URL . 'js/wepn.js', array('jquery'), false, true );
        wp_localize_script( 'wepn-js', 'ATU', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'venue_terms' => WEPN_Helper::venu_category_list(),
            'vendor_terms' => WEPN_Helper::category_list(),
        ) );

        if ( is_single() ) {
            wp_enqueue_script('acf-map', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', array(), false, true);
            wp_enqueue_script('wepn-map', WEPN_ASSETS_URL . 'js/google-map.js', array('acf-map'), false, true);
        }
    }




    function add_role() {

        remove_role( 'vendor' );
        add_role(
            'vendor',
            __( 'Vendor' ),
            array(
                'moderate_comments' => 0,
                'manage_categories' => 0,
                'manage_links' => 0,
                'upload_files' => 1,
                'unfiltered_html' => 1,
                'edit_posts' => 0,
                'edit_others_posts' => 0,
                'edit_published_posts' => 0,
                'publish_posts' => 0,
                'edit_pages' => 0,
                'read' => 1,
                'edit_others_pages' => 0,
                'edit_published_pages' => 0,
                'publish_pages' => 0,
                'delete_pages' => 0,
                'delete_others_pages' => 0,
                'delete_published_pages' => 0,
                'delete_posts' => 0,
                'delete_others_posts' => 0,
                'delete_published_posts' => 0,
                'delete_private_posts' => 0,
                'edit_private_posts' => 0,
                'read_private_posts' => 0,
                'delete_private_pages' => 0,
                'edit_private_pages' => 0,
                'read_private_pages' => 0,

            )
        );


        add_role(
            'venue',
            __( 'Venue' ),
            array(
                'moderate_comments' => 0,
                'manage_categories' => 0,
                'manage_links' => 0,
                'upload_files' => 1,
                'unfiltered_html' => 1,
                'edit_posts' => 1,
                'edit_others_posts' => 0,
                'edit_published_posts' => 1,
                'publish_posts' => 1,
                'edit_pages' => 0,
                'read' => 1,
                'edit_others_pages' => 0,
                'edit_published_pages' => 0,
                'publish_pages' => 0,
                'delete_pages' => 0,
                'delete_others_pages' => 0,
                'delete_published_pages' => 0,
                'delete_posts' => 1,
                'delete_others_posts' => 0,
                'delete_published_posts' => 1,
                'delete_private_posts' => 1,
                'edit_private_posts' => 1,
                'read_private_posts' => 1,
                'delete_private_pages' => 0,
                'edit_private_pages' => 0,
                'read_private_pages' => 0,

            )
        );

    }


    function wepn_install() {
        global $wpdb;

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        $charset_collate = $wpdb->get_charset_collate();

        $reg_code_tbl_name = $wpdb->prefix . WEPN_TBL_PREFIX . 'registration_code';

        $sql = "CREATE TABLE $reg_code_tbl_name (
            id mediumint(9) NOT NULL PRIMARY KEY AUTO_INCREMENT,
            code varchar(120) NOT NULL,
            is_active tinyint(1) DEFAULT 1 NOT NULL,
            date_created datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            date_used datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            UNIQUE KEY id (code)
        ) $charset_collate";



        dbDelta( $sql );

        $gallery_tbl_name = $wpdb->prefix . WEPN_TBL_PREFIX . 'user_gallery';
        $sql = "CREATE TABLE $gallery_tbl_name (
            id mediumint(9) NOT NULL PRIMARY KEY AUTO_INCREMENT,
            filename varchar(120) NOT NULL,
            file varchar(255) NOT NULL,
            path varchar(255) NOT NULL,
            date_created datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            sort VARCHAR(255) DEFAULT 0 NOT NULL
        ) $charset_collate";

        dbDelta( $sql );


        add_option( 'wepn_db_version', $this->wepn_db_version );

    }

    function  wepn_update_db_check() {

        if ( get_site_option( 'wepn_db_version' ) != $this->wepn_db_version ) {
            $this->wepn_install();
        }
    }


    /**
     * Hook into actions and filters
     * @since  2.3
     */
    private function init_hooks() {
        // Install database tables
        register_activation_hook( __FILE__, array( $this, 'wepn_install' ) );
        register_activation_hook( __FILE__, array( $this, 'add_role' ) );
        // Update database check
        add_action( 'plugins_loaded', array( $this, 'wepn_update_db_check' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_action( 'after_setup_theme', array( $this, 'wepn_theme_setup' ) );
        add_action( 'aut_post_thumnail', array( $this, 'wepn_post_thumbnail' ), 1, 2 );
        add_action( 'wepn_venue_search_form', array( $this, 'wepn_venue_search_form' ) );
        add_action( 'wepn_vendor_search_form', array( $this, 'wepn_vendor_search_form' ) );
        add_filter('posts_where', array( $this, 'websmart_search_where' ) );
        add_filter('posts_join', array( $this, 'websmart_search_join' ) );
        add_action( 'pre_get_posts', array( $this, 'wepn_advance_search' ) );
        add_action( 'wepn_venue_region_list', array( $this, 'wepn_region_list' ) );

        if (isset($_REQUEST['post_type']) && !empty($_REQUEST['post_type'])) {
            add_filter('template_include', array($this, 'template_chooser'));
        }





        add_filter( 'wpcf7_form_tag', array($this, 'dynamic_vendor_category_list'), 10, 2);
        add_filter( 'wpcf7_form_tag', array($this, 'dynamic_select_list'), 10, 2);
        add_filter( 'wpcf7_form_tag', array($this, 'capacity_list'), 10, 2);
        add_filter( 'wpcf7_form_tag', array($this, 'post_code_list'), 10, 2);
        add_action( 'admin_menu', array($this, 'wpse28782_remove_menu_items' ));
        add_filter('cbratingsystem_post_types', function() {
            return array(
                'builtin' => array(
                    'options' => array(
                        'public'   => true,
//                '_builtin' => false,
                        'show_ui'  => true,
                    ),
                    'label'   => __( 'Built in post types', 'cbratingsystem' ),
                )

            );


        }, 10);


        add_action( 'delete_user', array($this, 'custom_remove_user'), 10 );
    }



    function custom_remove_user( $user_id ) {

        $company_id = get_user_meta( $user_id, 'company', true );

        wp_delete_post( $company_id, true );
    }

    function capacity_list($tag, $unused) {


        $options = (array)$tag['options'];

        foreach ($options as $option)
            if (preg_match('%^capacity:([-0-9a-zA-Z_]+)$%', $option, $matches))
                $term = $matches[1];

        //check if post_type is set
        if(!isset($term))
            return $tag;

        $capacity = get_field( 'capacity', 'option' );

        $capacity_array = explode( "\r\n", $capacity );



        if ( count( $capacity_array ) != 0 ) {
            foreach ($capacity_array as $capacity) {
                $label = wp_strip_all_tags($capacity);

                $tag['raw_values'][] = $label;
                $tag['values'][] = $label;
                $tag['labels'][] =$label;


            }
        }



        return $tag;


    }

    function post_code_list($tag, $unused) {


        $options = (array)$tag['options'];

        foreach ($options as $option)
            if (preg_match('%^postcode:([-0-9a-zA-Z_]+)$%', $option, $matches))
                $term = $matches[1];

        //check if post_type is set
        if(!isset($term))
            return $tag;

        $post_codes = get_field( 'post_codes', 'option' );

        $post_codes_array = explode( "\r\n", $post_codes );



        if ( count( $post_codes_array ) != 0 ) {
            foreach ($post_codes_array as $post_code) {
                $label = wp_strip_all_tags($post_code);

                $tag['raw_values'][] = $label;
                $tag['values'][] = $label;
                $tag['labels'][] =$label;


            }
        }



        return $tag;


    }
    /** Dynamic List for Contact Form 7 **/
    /** Usage: [select name vendor:vendors_categories] **/
    function dynamic_vendor_category_list($tag, $unused){
        $options = (array)$tag['options'];

        foreach ($options as $option)
            if (preg_match('%^vendor:([-0-9a-zA-Z_]+)$%', $option, $matches))
                $term = $matches[1];

        //check if post_type is set
        if(!isset($term))
            return $tag;

        if ( have_rows( 'vendors_categories', 'option' ) ) {

            while ( have_rows( 'vendors_categories', 'option' ) ) {
                the_row();
                $label = esc_html(get_sub_field('category_name'));

                $tag['raw_values'][] = $label;
                $tag['values'][] = $label;
                $tag['labels'][] =$label;

            }
        }



        return $tag;
    }




    /** Dynamic List for Contact Form 7 **/
    /** Usage: [select name term:taxonomy_name] **/
    function dynamic_select_list($tag, $unused){
        $options = (array)$tag['options'];

        foreach ($options as $option)
            if (preg_match('%^term:([-0-9a-zA-Z_]+)$%', $option, $matches))
                $term = $matches[1];

        //check if post_type is set
        if(!isset($term))
            return $tag;

        $taxonomy = get_terms($term, array('hide_empty' => 0));

        if (!$taxonomy)
            return $tag;

        foreach ($taxonomy as $cat) {
            $tag['raw_values'][] = $cat->slug;
            $tag['values'][] = $cat->name;
            $tag['labels'][] = $cat->name;
        }


        return $tag;
    }




    public function template_chooser($template)
    {
        global $wp_query;

        $post_type = $_REQUEST['post_type'];
        if ($wp_query->is_search && $post_type == 'venue') {
            return locate_template('archive-venue.php');
        } elseif ($wp_query->is_search && $post_type == 'vendor') {
            return locate_template('archive-vendor.php');
        }


        return $template;
    }





    public function wepn_advance_search( $query ) {



        if ( !is_admin() && $query->is_main_query() && $query->is_search ) {


            $city = isset($_REQUEST['city']) && !empty($_REQUEST['city']) ? esc_attr($_REQUEST['city']) : 'sydney';
            $region = isset($_REQUEST['region']) && !empty($_REQUEST['region']) ? esc_attr($_REQUEST['region']) : '';

            $_SESSION['wepn']['url_segment'] = array(
                'city'      => $city,
                'region'    => $region,
            );



            if (isset($_REQUEST['post_type']) && !empty($_REQUEST['post_type'])) {
                $query->set('post_type', array($_REQUEST['post_type']));
            }

            if (is_post_type_archive('venue')) {
                $tax = 'venue-category';
                $field = 'id';
            }  elseif (is_post_type_archive('vendor')) {
                $tax = $city;
                $field = 'slug';

                $query->set('meta_query', array(
                    array(
                        'key' => 'vendor', // name of custom field
                        'value' => WEPN_Helper::get_user_ids_by_role('vendor'), // matches exaclty "red", not just red. This prevents a match for "acquired"
                        'compare' => 'IN'
                    )
                ));


                $query->set('meta_key', 'vendor' );
                $query->set('orderby', 'meta_value_num');
                $query->set('order', 'DESC');


            }


            if (isset($_REQUEST['category']) && !empty($_REQUEST['category']) ) {
                $query->set('tax_query', array(
                    array(
                        'taxonomy' => $tax,
                        'field' => $field,
                        'terms' => array(esc_attr($_REQUEST['category'])),
                        'operator' => 'IN'
                    )
                ));
            }


        }

        return $query;
    }




    public function websmart_search_join( $join ) {
        global $wpdb;

//        if ( ! is_search() && is_admin() ) return $join;

        if (is_search()) {

            if (isset($_REQUEST['post_code']) && !empty($_REQUEST['post_code'])) {
                $join .= " LEFT JOIN $wpdb->postmeta AS m ON $wpdb->posts.ID = m.post_id AND m.meta_key='post_code'";
            }

            if (isset($_REQUEST['capacity']) && !empty($_REQUEST['capacity'])) {
                $join .= " LEFT JOIN $wpdb->postmeta AS m1 ON $wpdb->posts.ID = m1.post_id AND m1.meta_key='capacity'";
            }


            if (isset($_REQUEST['city']) && !empty($_REQUEST['city'])) {
                $join .= " LEFT JOIN $wpdb->postmeta AS m2 ON $wpdb->posts.ID = m2.post_id  AND m2.meta_key='city'";
            }


            if (isset($_REQUEST['region']) && !empty($_REQUEST['region'])) {
                $join .= " LEFT JOIN $wpdb->postmeta AS m3 ON $wpdb->posts.ID = m3.post_id  AND m3.meta_key='region'";
            }
        }


        return $join;
    }



    public function websmart_search_where( $where ) {

        //if ( ! is_search() && is_admin() ) return $where;

        if ( is_search() ) {

            if (isset($_REQUEST['post_type']) && $_REQUEST['post_type'] == 'venue' && is_post_type_archive('venue')) {
                $where = str_replace('0 = 1', '1 = 1', $where);
            }

            if (isset($_REQUEST['post_code']) && !empty($_REQUEST['post_code'])) {

                $where .= " AND ( m.meta_key = 'post_code' AND m.meta_value='" . esc_attr($_REQUEST['post_code']) . "' ) ";
            }

            if (isset($_REQUEST['city']) && !empty($_REQUEST['city'])) {

                $where .= " AND ( m2.meta_value = '" . esc_attr($_REQUEST['city']) . "' ) ";
            }

            if (isset($_REQUEST['capacity']) && !empty($_REQUEST['capacity'])) {

                $where .= " AND (  CAST(TRIM(SUBSTRING_INDEX(m1.meta_value, '-', 1)) AS SIGNED) >= CAST(TRIM(SUBSTRING_INDEX('" . esc_attr($_REQUEST['capacity']) . "', '-', 1)) AS SIGNED) ) ";
            }

            if (isset($_REQUEST['region']) && !empty($_REQUEST['region'])) {
                $where .= " AND ( m3.meta_value='" . esc_attr($_REQUEST['region']) . "' ) ";
            }

        }

        return $where;
    }


    public function wepn_vendor_search_form() {
        ?>

        <form id="vendorSearchForm" action="<?php echo home_url( '/' ); ?>" method="post" class="form">
            <div class="row row-sm">
                <div class="col-md-3">
                    <div class="form-group">
                    <input type="text" name="s" value="<?php echo isset( $_REQUEST['s'] ) ? $_REQUEST['s'] : ''; ?>" class="form-control input-block" placeholder="<?php _e( 'Keyword...', 'atu' ); ?>">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <?php WEPN_Helper::dropwdown_cities(); ?>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <?php WEPN_Helper::dropwdown_regions(); ?>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                            <?php WEPN_Helper::dropwdown_vendor_category(array(
                                'selected' => isset( $_REQUEST['category'] ) ? $_REQUEST['category'] : ''
                            )); ?>
                    </div>
                </div>
                <div class="col-md-2">

                    <input type="hidden" name="post_type" value="vendor">
                    <button class="btn btn-secondary btn-block" ><?php _e( 'Search', 'atu' ); ?></button>
                </div>
            </div>
        </form>
    <?php
    }



    public function wepn_venue_search_form() {

        ?>
        <form id="venueSearchForm" action="<?php echo home_url( '/' ); ?>" method="post" class="form">
            <div class="row row-sm">

                <div class="col-md-2">
                    <div class="form-group">
                        <?php
                        $selected_post_code = isset( $_REQUEST['post_code'] ) ? $_REQUEST['post_code'] : '';
                        $post_codes = get_field( 'post_codes', 'option' );

                        $post_codes_array = explode( "\r\n", $post_codes );



                        if ( count( $post_codes_array ) != 0 ) {
                            echo '<select name="post_code" class="form-control">';
                            echo '<option value=""'. selected('', $selected_post_code) .'>-- Post Code --</option>';
                            foreach ( $post_codes_array as $post_code ) {
                                $post_code = wp_strip_all_tags( $post_code );
                                echo '<option value="'. $post_code .'" '. selected( $post_code, $selected_post_code, false ) .'>'. $post_code .'</option>';
                            }
                            echo '<select>';
                        }?>
                    </div>
                </div>



                <div class="col-md-3">
                    <div class="form-group">
                        <?php WEPN_Helper::dropwdown_cities(); ?>
                    </div>
                </div>


                <div class="col-md-2">
                    <div class="form-group">

                        <?php
                        $selected_capacity = isset( $_REQUEST['capacity'] ) ? $_REQUEST['capacity'] : '';
                        $capacities = get_field( 'capacity', 'option' );

                        $capacities_array = explode( "\r\n", $capacities );



                        if ( count( $capacities_array ) != 0 ) {
                            echo '<select name="capacity" class="form-control">';
                            echo '<option value=""'. selected('', $selected_capacity) .'>-- Capacity --</option>';
                            foreach ( $capacities_array as $capacity ) {
                                $capacity = wp_strip_all_tags( $capacity );
                                echo '<option value="'. $capacity .'" '. selected( $capacity, $selected_capacity, false ) .'>'. $capacity .'</option>';
                            }
                            echo '<select>';
                        }?>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <?php wp_dropdown_categories( array(
                            'taxonomy'  => 'venue-category',
                            'name'               => 'category',
                            'selected'              => isset( $_REQUEST['category'] ) ? $_REQUEST['category'] : '-1',
                            'hide_empty'         => 0,
                            'class'              => 'form-control',
                            'show_option_none'   => '-- Select Category --',
                            'option_none_value'  => '-1',
                        ) ); ?>
                    </div>
                </div>

                <div class="col-md-2">
                    <input type="hidden" name="s" value="">
                    <input type="hidden" name="post_type" value="venue">
                    <button class="btn btn-secondary btn-block" ><?php _e( 'Search', 'atu' ); ?></button>
                </div>
            </div>
        </form>
    <?php
    }









    public function wepn_post_thumbnail( $size = 'venue-medium', $attr = array( 'alt' => 'Venue image' ) ) {
        if ( has_post_thumbnail() ) {
            the_post_thumbnail( $size, $attr );
        } else {
            echo '<img src="'. get_template_directory_uri() .'/images/placeholders/slide-single.jpg" alt="">';
        }
    }

    /**
     * Define ATU Constants
     */

    private function define_constant() {
        $this->define( 'WEPN_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
        $this->define( 'WEPN_PLUGIN_URL', plugin_dir_url(__FILE__) );
        $this->define( 'WEPN_INCLUDES_DIR', WEPN_PLUGIN_DIR . 'includes' );
        $this->define( 'WEPN_ASSSETS_DIR', WEPN_PLUGIN_DIR . 'assets' );
        $this->define( 'WEPN_ASSETS_URL', WEPN_PLUGIN_URL . 'assets/' );
        $this->define( 'WEPN_CLASSES_DIR', WEPN_PLUGIN_DIR . 'classes' );
        $this->define( 'WEPN_TBL_PREFIX', 'wepn_' );
        $this->define( 'WEPN_TEXT_DOMAIN', 'wepn' );
    }


    /**
     * Define constant if not already set
     * @param  string $name
     * @param  string|bool $value
     */
    private function define( $name, $value ) {
        if ( ! defined( $name ) ) {
            define( $name, $value );
        }
    }

    private function includes() {
        include_once('includes/class-wepn-install.php');
    }
}

$GLOBALS['WEPN'] = new WEPN();
