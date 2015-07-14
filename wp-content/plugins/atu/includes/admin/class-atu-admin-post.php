<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'ATU_Admin_Post' ) ) {
    class ATU_Admin_Post {
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

            /* OK, it's safe for us to save the data now. */

            // Make sure that it is set.
            if ( ! isset( $_POST['region'] ) ) { //|| ! isset( $_POST['group'] ) || ! isset( $_POST['category'] )
                return;
            }


            $region = $_POST['region'];
            /*$group = explode( '::', $_POST['group'] );
            $category = $_POST['category'];


            $group_title = $group[1];
            $group_slug = sanitize_title( $group[0] );

            $category_slug = sanitize_title( $category );*/




            /* Sets the terms (we're just using a single term) for the user. */
            /*
            if ( ! $parent = term_exists( $group_title, $region ) ) {
                $parent = wp_insert_term( $group_title, $region, array(
                    'slug' => $group_slug,
                ));
            }

            if ( ! term_exists( $category, $region ) ) {

                wp_insert_term($category, $region, array(
                    'slug' => $category_slug,
                    'parent' => $parent['term_id']
                ));

            }
            */




           // wp_delete_object_term_relationships( $post_id, $region );


            //wp_set_object_terms($post_id, $category_slug, $region, false);

            update_post_meta( $post_id, 'region', $region );
            //update_user_meta( $post_id, 'group', $group_slug );
            //update_user_meta( $post_id, 'category', $category_slug );



            //clean_object_term_cache( $post_id, $region );



        }


        public function wepn_custom_add_meta_box() {
            $screens = array( 'venue' ); //'vendor',

            foreach ( $screens as $screen ) {

                add_meta_box(
                    'wepn_sectionid',
                    __( 'Region', 'wepn' ),
                    array( $this, 'wepn_meta_box_callback' ),
                    $screen
                );
            }
        }


        public function wepn_meta_box_callback( $post ) {
            wp_nonce_field( 'wepn_save_meta_box_data', 'wepn_meta_box_nonce' );

            $region = get_post_meta( $post->ID, 'region', true );
            ?>
            <table class="form-table">
                <tr>
                    <th><label for="">Select Region</label></th>
                    <td>
                        <?php if ( have_rows( 'regions', 'option' ) ) {
                            echo '<select name="region">';
                            while ( have_rows( 'regions', 'option' ) ) {
                                the_row();
                                $name = sanitize_title(get_sub_field('region_name'));
                                $label = esc_html(get_sub_field('region_label'));

                                echo '<option value="'. $name .'" '. selected( $name, $region, false ) .'>'. $label .'</option>';
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
                        'name'               => _x( 'Venues', 'post type general name', ATU_TEXT_DOMAIN ),
                        'singular_name'      => _x( 'Venue', 'post type singular name', ATU_TEXT_DOMAIN ),
                        'menu_name'          => _x( 'Venues', 'admin menu', ATU_TEXT_DOMAIN ),
                        'name_admin_bar'     => _x( 'Venue', 'add new on admin bar', ATU_TEXT_DOMAIN ),
                        'add_new'            => _x( 'Add New', 'Venue', ATU_TEXT_DOMAIN ),
                        'add_new_item'       => __( 'Add New Venue', ATU_TEXT_DOMAIN ),
                        'new_item'           => __( 'New Venue', ATU_TEXT_DOMAIN ),
                        'edit_item'          => __( 'Edit Venue', ATU_TEXT_DOMAIN ),
                        'view_item'          => __( 'View Venue', ATU_TEXT_DOMAIN ),
                        'all_items'          => __( 'All Venues', ATU_TEXT_DOMAIN ),
                        'search_items'       => __( 'Search Venues', ATU_TEXT_DOMAIN ),
                        'parent_item_colon'  => __( 'Parent Venues:', ATU_TEXT_DOMAIN ),
                        'not_found'          => __( 'No Venues found.', ATU_TEXT_DOMAIN ),
                        'not_found_in_trash' => __( 'No Venues found in Trash.', ATU_TEXT_DOMAIN )
                    ),
                    'public'             => true,
                    'publicly_queryable' => true,
                    'show_ui'            => true,
                    'show_in_menu'       => true,
                    'query_var'          => true,
                    'rewrite'            => array( 'slug' => 'venue' ),
                    'capability_type'    => 'post',
                    'has_archive'        => true,
                    'hierarchical'       => false,
                    'menu_position'      => null,
                    'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
                ),
                'vendor' => array(
                    'labels'             => array(
                        'name'               => _x( 'Vendors', 'post type general name', ATU_TEXT_DOMAIN ),
                        'singular_name'      => _x( 'Vendor', 'post type singular name', ATU_TEXT_DOMAIN ),
                        'menu_name'          => _x( 'Vendors', 'admin menu', ATU_TEXT_DOMAIN ),
                        'name_admin_bar'     => _x( 'Vendor', 'add new on admin bar', ATU_TEXT_DOMAIN ),
                        'add_new'            => _x( 'Add New', 'Vendor', ATU_TEXT_DOMAIN ),
                        'add_new_item'       => __( 'Add New Vendor', ATU_TEXT_DOMAIN ),
                        'new_item'           => __( 'New Vendor', ATU_TEXT_DOMAIN ),
                        'edit_item'          => __( 'Edit Vendor', ATU_TEXT_DOMAIN ),
                        'view_item'          => __( 'View Vendor', ATU_TEXT_DOMAIN ),
                        'all_items'          => __( 'All Vendors', ATU_TEXT_DOMAIN ),
                        'search_items'       => __( 'Search Vendors', ATU_TEXT_DOMAIN ),
                        'parent_item_colon'  => __( 'Parent Vendors:', ATU_TEXT_DOMAIN ),
                        'not_found'          => __( 'No Vendors found.', ATU_TEXT_DOMAIN ),
                        'not_found_in_trash' => __( 'No Vendors found in Trash.', ATU_TEXT_DOMAIN )
                    ),
                    'public'             => true,
                    'publicly_queryable' => true,
                    'show_ui'            => true,
                    'show_in_menu'       => false,
                    'query_var'          => true,
                    'rewrite'            => array( 'slug' => 'vendors', 'with_front' => false ),///%group%
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

return new ATU_Admin_Post();