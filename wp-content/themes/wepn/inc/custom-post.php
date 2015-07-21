<?php 

function my_custom_post_portfolio() {
  $labels = array(
    'name'               => _x( 'Portfolio', 'post type general name' ),
    'singular_name'      => _x( 'Portfolio', 'post type singular name' ),
    'add_new'            => _x( 'Add New Image', 'book' ),
    'add_new_item'       => __( 'Add New Image' ),
    'edit_item'          => __( 'Edit Item' ),
    'new_item'           => __( 'New Item' ),
    'all_items'          => __( 'All Images' ),
    'view_item'          => __( 'View Item' ),
    'search_items'       => __( 'Search Item' ),
    'not_found'          => __( 'No Item found' ),
    'not_found_in_trash' => __( 'No Item found in the Trash' ), 
    'parent_item_colon'  => '',
    'menu_name'          => 'Portfolio Gallery'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Portfolio images goes here',
    'public'        => true,
    'menu_position' => 8,
    'menu_icon' => 'dashicons-images-alt2',
    'supports'      => array( 'title', 'editor', 'thumbnail' ),
    'has_archive'   => true,
  );
  register_post_type( 'portfolio', $args ); 
}
add_action( 'init', 'my_custom_post_portfolio' );


function my_custom_post_meetup() {
  $labels = array(
    'name'               => _x( 'Meetup Groups', 'post type general name' ),
    'singular_name'      => _x( 'Meetup Groups', 'post type singular name' ),
    'add_new'            => _x( 'Add New group', 'book' ),
    'add_new_item'       => __( 'Add New group' ),
    'edit_item'          => __( 'Edit group' ),
    'new_item'           => __( 'New group' ),
    'all_items'          => __( 'All groups' ),
    'view_item'          => __( 'View group' ),
    'search_items'       => __( 'Search group' ),
    'not_found'          => __( 'No group found' ),
    'not_found_in_trash' => __( 'No group found in the Trash' ), 
    'parent_item_colon'  => '',
    'menu_name'          => 'Meetup Groups Gallery'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Meetup Group images goes here',
    'public'        => true,
    'menu_position' => 8,
    'menu_icon' => 'dashicons-groups',
    'supports'      => array( 'title', 'thumbnail' ),
    'has_archive'   => true,
  );
  register_post_type( 'meetup_groups', $args ); 
}
add_action( 'init', 'my_custom_post_meetup' );


