<?php

if ( ! defined('ABSPATH') ) {
    exit;
}

if ( ! class_exists('WEPN_Admin_Taxonomy') ) {
    class WEPN_Admin_Taxonomy {
        public function __construct() {
            $this->init_hooks();
        }

        private function init_hooks() {
            add_action( 'init', array( $this, 'post_type_init' ) );


        }



        public function post_type_init() {

            $post_types = array(
                'venue-category' => array(
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
                        'rewrite'           => array( 'slug' => 'venue-cat' ),
                    )
                )
            );


            foreach ( $post_types as $type => $args ) {
                register_taxonomy( $type, $args['post_type'], $args['args'] );
            }



            if ( have_rows( 'cities', 'option' ) ) {
                while ( have_rows( 'cities', 'option' ) ) { the_row();
                    $name =  sanitize_title( get_sub_field( 'city_name' ) );
                    $label = esc_html( get_sub_field( 'city_label' ) );
                    $slug = $name; //get_sub_field( 'region_slug' ) ? sanitize_title( get_sub_field( 'region_slug' ) ) : $name;

                    register_taxonomy(
                        $name,
                        array('vendor'),
                        array(
                            'public' => true,
                            'labels' => array(
                                'name' => __( $label. ' Categories' ),
                                'singular_name' => __( $label . ' Category' ),
                                'menu_name' => $label,
                                'search_items' => __( 'Search '. $label .' Categories' ),
                                'popular_items' => __( 'Popular '. $label .' Categories' ),
                                'all_items' => __( 'All '. $label .' Categories' ),
                                'edit_item' => __( 'Edit '. $label .' Category' ),
                                'update_item' => __( 'Update '. $label .' Category' ),
                                'add_new_item' => __( 'Add New '. $label .' Category' ),
                                'new_item_name' => __( 'New Group '. $label .' Name' ),
                                'separate_items_with_commas' => __( 'Separate '. $label .' categories with commas' ),
                                'add_or_remove_items' => __( 'Add or remove '. $label .' category' ),
                                'choose_from_most_used' => __( 'Choose from the most popular '. $label .' categories' ),
                            ),
                            'hierarchical'          => true,
                            'show_ui'               => false,
                            'show_admin_column'     => true,
                            'query_var'             => true,
                            'show_in_nav_menus'     => false,
                            'rewrite' => array(
                                //'with_front' => true,
                                'hierarchical' => true,
                               // 'slug' => $slug
                            ),
                            //'update_count_callback' => array( $this, 'my_update_profession_count' ) // Use a custom function to update the count.
                        )
                    );



                }
            }



        }
    }
}

return new WEPN_Admin_Taxonomy();

