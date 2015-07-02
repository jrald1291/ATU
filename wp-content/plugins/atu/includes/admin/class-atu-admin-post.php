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
                )
            );

            foreach ( $post_types as $type => $args ) {
                register_post_type( $type, $args );
            }
            
            
        }
    }
}

return new ATU_Admin_Post();