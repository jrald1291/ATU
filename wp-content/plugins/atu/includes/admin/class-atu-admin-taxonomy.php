<?php

if ( ! defined('ABSPATH') ) {
    exit;
}

if ( ! class_exists( 'ATU_Admin_Taxonomy' ) ) {
    class ATU_Admin_Taxonomy {
        public function __construct() {
            $this->init_hooks();
        }

        private function init_hooks() {
            add_action( 'init', array( $this, 'post_type_init' ) );


        }



        public function post_type_init() {

            $post_types = array(
                'venu-category' => array(
                    'post_type' => array( 'venue' ),
                    'args'      => array(
                        'hierarchical'      => true,
                        'labels'            => array(
                            'name'              => _x( 'Categories', 'taxonomy general name' ),
                            'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
                            'search_items'      => __( 'Search Categories' ),
                            'all_items'         => __( 'All Categories' ),
                            'parent_item'       => __( 'Parent Category' ),
                            'parent_item_colon' => __( 'Parent Category:' ),
                            'edit_item'         => __( 'Edit Category' ),
                            'update_item'       => __( 'Update Category' ),
                            'add_new_item'      => __( 'Add New Category' ),
                            'new_item_name'     => __( 'New Category Name' ),
                            'menu_name'         => __( 'Categories' ),
                        ),
                        'show_ui'           => true,
                        'show_admin_column' => true,
                        'query_var'         => true,
                        'rewrite'           => array( 'slug' => 'venu-category' ),
                    )
                )
            );

            foreach ( $post_types as $type => $args ) {
                register_taxonomy( $type, $args['post_type'], $args['args'] );
            }
        }
    }
}

return new ATU_Admin_Taxonomy();

