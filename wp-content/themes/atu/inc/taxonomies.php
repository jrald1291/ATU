<?php 

   $labels = array(
      'name'                       => _x( 'Portfolio Category', 'taxonomy general name' ),
      'singular_name'              => _x( 'Portfolio Category', 'taxonomy singular name' ),
      'search_items'               => __( 'Search Categories' ),
      'popular_items'              => __( 'Popular Categories' ),
      'all_items'                  => __( 'All Categories' ),
      'parent_item'                => null,
      'parent_item_colon'          => null,
      'edit_item'                  => __( 'Edit Category' ),
      'update_item'                => __( 'Update Category' ),
      'add_new_item'               => __( 'Add New Category' ),
      'new_item_name'              => __( 'New Category Name' ),
      'separate_items_with_commas' => __( 'Separate categories with commas' ),
      'add_or_remove_items'        => __( 'Add or remove categories' ),
      'choose_from_most_used'      => __( 'Choose from the most used categories' ),
      'not_found'                  => __( 'No categories found.' ),
      'menu_name'                  => __( 'Portfolio Category' ),
  );

  $args = array(
      'hierarchical'          => true,
      'show_option_all'       => true,
      'labels'                => $labels,
      'show_ui'               => true,
      'show_admin_column'     => true,
      'update_count_callback' => '_update_post_term_count',
      'query_var'             => true,
      'rewrite'               => array( 'slug' => 'portfolio-category' )
  );

  register_taxonomy( 'portfolio-category', 'portfolio', $args );