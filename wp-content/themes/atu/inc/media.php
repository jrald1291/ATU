<?php 

// Custom Sizes Media
function setup() {  
	if(function_exists('add_theme_support')) {
		add_theme_support( 'post-thumbnails' );
		
		add_image_size( 'small', 177, 125, true );
		
	}
}
add_action( 'after_setup_theme', 'setup' );