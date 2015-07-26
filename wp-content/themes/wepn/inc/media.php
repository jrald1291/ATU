<?php 

// Custom Sizes Media
function setup() {  
	if(function_exists('add_theme_support')) {
		add_theme_support( 'post-thumbnails' );
		
		add_image_size( 'img-lscape', 455, 230, true );
		add_image_size( 'img-wide', 860, 320, true );
		add_image_size( 'slide-wide', 800, 320);
		add_image_size( 'img-avatar', 219, 219, true );
		
	}
}
add_action( 'after_setup_theme', 'setup' );