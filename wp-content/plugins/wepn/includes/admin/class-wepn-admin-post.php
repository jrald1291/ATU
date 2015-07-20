<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists('WEPN_Admin_Post') ) {
    class WEPN_Admin_Post {
        public function __construct() {
            $this->init_hooks();
        }

        private function init_hooks() {
            add_action( 'init', array( $this, 'post_type_init' ) );

            add_action( 'add_meta_boxes', array( $this, 'wepn_custom_add_meta_box' ) );
            add_action( 'save_post', array( $this, 'wepn_save_meta_box_data' ) );
        }


        public function wepn_save_meta_box_data( $post_id ) {
            /*
             * We need to verify this came from our screen and with proper authorization,
             * because the save_post action can be triggered at other times.
             */

            // Check if our nonce is set.
            if ( ! isset( $_POST['wepn_meta_box_nonce'] ) ) {
                return;
            }

            // Verify that the nonce is valid.
            if ( ! wp_verify_nonce( $_POST['wepn_meta_box_nonce'], 'wepn_save_meta_box_data' ) ) {
                return;
            }

            // If this is an autosave, our form has not been submitted, so we don't want to do anything.
            if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
                return;
            }

            // Check the user's permissions.
            if ( isset( $_POST['post_type'] ) && 'venue' == $_POST['post_type'] ) {

                if ( ! current_user_can( 'edit_page', $post_id ) ) {
                    return;
                }

            } else {

                if ( ! current_user_can( 'edit_post', $post_id ) ) {
                    return;
                }
            }



            $city = $_POST['city'];
            $post_code = $_POST['post_code'];
            $capacity = $_POST['capacity'];

            update_post_meta( $post_id, 'city', $city );
            update_post_meta( $post_id, 'post_code', $post_code );
            update_post_meta( $post_id, 'capacity', $capacity );



        }


        public function wepn_custom_add_meta_box() {
            $screens = array( 'venue' ); //'vendor',

            foreach ( $screens as $screen ) {

                add_meta_box(
                    'wepn_sectionid',
                    __( 'City/Post code/Capacity', 'wepn' ),
                    array( $this, 'wepn_meta_box_callback' ),
                    $screen
                );
            }
        }


        public function wepn_meta_box_callback( $post ) {
            wp_nonce_field( 'wepn_save_meta_box_data', 'wepn_meta_box_nonce' );

            $city = get_post_meta( $post->ID, 'city', true );
            $selected_post_code = get_post_meta( $post->ID, 'post_code', true );
            $selected_capacity = get_post_meta( $post->ID, 'capacity', true );

            ?>
            <table class="form-table">
                <tr>
                    <th><label for="">Select City</label></th>
                    <td>
                        <?php if ( have_rows( 'cities', 'option' ) ) {
                            echo '<select name="city">';
                            while ( have_rows( 'cities', 'option' ) ) {
                                the_row();
                                $name = sanitize_title(get_sub_field('city_name'));
                                $label = esc_html(get_sub_field('city_label'));

                                echo '<option value="'. $name .'" '. selected( $name, $city, false ) .'>'. $label .'</option>';
                            }
                            echo '<select>';
                        }?>
                    </td>
                </tr>

                <tr>
                    <th><label for="">Post Code</label></th>
                    <td>
                        <?php
                            $post_codes = get_field( 'post_codes', 'option' );

                            $post_codes_array = explode( "\r\n", $post_codes );



                            if ( count( $post_codes_array ) != 0 ) {
                            echo '<select name="post_code">';
                            foreach ( $post_codes_array as $post_code ) {
                                $post_code = wp_strip_all_tags( $post_code );
                                echo '<option value="'. $post_code .'" '. selected( $post_code, $selected_post_code, false ) .'>'. $post_code .'</option>';
                            }
                            echo '<select>';
                        }?>
                    </td>
                </tr>

                <tr>
                    <th><label for="">Capacity</label></th>
                    <td>
                        <?php
                        $capacities = get_field( 'capacity', 'option' );

                        $capacities_array = explode( "\r\n", $capacities );



                        if ( count( $capacities_array ) != 0 ) {
                            echo '<select name="capacity">';
                            foreach ( $capacities_array as $capacity ) {
                                $capacity = wp_strip_all_tags( $capacity );
                                echo '<option value="'. $capacity .'" '. selected( $capacity, $selected_capacity, false ) .'>'. $capacity .'</option>';
                            }
                            echo '<select>';
                        }?>
                    </td>
                </tr>




            </table>

            <?php
        }

        public function post_type_init() {

            $post_types = array(
                'venue' => array(
                    'labels'             => array(
                        'name'               => _x( 'Venues', 'post type general name', WEPN_TEXT_DOMAIN ),
                        'singular_name'      => _x( 'Venue', 'post type singular name', WEPN_TEXT_DOMAIN ),
                        'menu_name'          => _x( 'Venues', 'admin menu', WEPN_TEXT_DOMAIN ),
                        'name_admin_bar'     => _x( 'Venue', 'add new on admin bar', WEPN_TEXT_DOMAIN ),
                        'add_new'            => _x( 'Add New', 'Venue', WEPN_TEXT_DOMAIN ),
                        'add_new_item'       => __( 'Add New Venue', WEPN_TEXT_DOMAIN ),
                        'new_item'           => __( 'New Venue', WEPN_TEXT_DOMAIN ),
                        'edit_item'          => __( 'Edit Venue', WEPN_TEXT_DOMAIN ),
                        'view_item'          => __( 'View Venue', WEPN_TEXT_DOMAIN ),
                        'all_items'          => __( 'All Venues', WEPN_TEXT_DOMAIN ),
                        'search_items'       => __( 'Search Venues', WEPN_TEXT_DOMAIN ),
                        'parent_item_colon'  => __( 'Parent Venues:', WEPN_TEXT_DOMAIN ),
                        'not_found'          => __( 'No Venues found.', WEPN_TEXT_DOMAIN ),
                        'not_found_in_trash' => __( 'No Venues found in Trash.', WEPN_TEXT_DOMAIN )
                    ),
                    'public'             => true,
                    'publicly_queryable' => true,
                    'show_ui'            => true,
                    'show_in_menu'       => true,
                    'query_var'          => true,
                    'rewrite'            => array( 'slug' => 'venue', 'with_front' => false ),
                    'capability_type'    => 'post',
                    'has_archive'        => true,
                    'hierarchical'       => false,
                    'menu_position'      => null,
                    'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
                ),
                'vendor' => array(
                    'labels'             => array(
                        'name'               => _x( 'Suppliers', 'post type general name', WEPN_TEXT_DOMAIN ),
                        'singular_name'      => _x( 'Supplier', 'post type singular name', WEPN_TEXT_DOMAIN ),
                        'menu_name'          => _x( 'Suppliers', 'admin menu', WEPN_TEXT_DOMAIN ),
                        'name_admin_bar'     => _x( 'Supplier', 'add new on admin bar', WEPN_TEXT_DOMAIN ),
                        'add_new'            => _x( 'Add New', 'Vendor', WEPN_TEXT_DOMAIN ),
                        'add_new_item'       => __( 'Add New Vendor', WEPN_TEXT_DOMAIN ),
                        'new_item'           => __( 'New Supplier', WEPN_TEXT_DOMAIN ),
                        'edit_item'          => __( 'Edit Supplier', WEPN_TEXT_DOMAIN ),
                        'view_item'          => __( 'View Supplier', WEPN_TEXT_DOMAIN ),
                        'all_items'          => __( 'All Suppliers', WEPN_TEXT_DOMAIN ),
                        'search_items'       => __( 'Search Suppliers', WEPN_TEXT_DOMAIN ),
                        'parent_item_colon'  => __( 'Parent Suppliers:', WEPN_TEXT_DOMAIN ),
                        'not_found'          => __( 'No suppliers found.', WEPN_TEXT_DOMAIN ),
                        'not_found_in_trash' => __( 'No suppliers found in Trash.', WEPN_TEXT_DOMAIN )
                    ),
                    'public'             => true,
                    'publicly_queryable' => true,
                    'show_ui'            => true,
                    'show_in_menu'       => false,
                    'query_var'          => true,
                    'rewrite'            => array( 'slug' => 'suppliers', 'hierarchical' => true, 'with_front' => false ),///%group%
                    'capability_type'    => 'post',
                    'has_archive'        => true,
                    'hierarchical'       => false,
                    'menu_position'      => null,
                    'supports'           => array( 'title' )
                )
            );

            foreach ( $post_types as $type => $args ) {
                register_post_type( $type, $args );
            }
            
            
        }
    }
}

return new WEPN_Admin_Post();




