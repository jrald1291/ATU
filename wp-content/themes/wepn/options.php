<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

	$options[] = array(
		'name' => __('ATU Details', 'options_framework_theme'),
		'type' => 'heading');
	$options[] = array(
		'name' => __('Website Logo', 'options_framework_theme'),
		'desc' => __('Upload your logo image( size must be 175 x 75)', 'options_framework_theme'),
		'id' => 'logo_uploader',
		'type' => 'upload');
	$options[] = array(
		'name' => __('Footer Logo', 'options_framework_theme'),
		'desc' => __('Upload your logo image( size must be 220 x 100) or smaller', 'options_framework_theme'),
		'id' => 'footer_logo',
		'type' => 'upload');
	$options[] = array(
		'name' => __('Email', 'options_framework_theme'),
		'desc' => __('Enter Email address', 'options_framework_theme'),
		'id' => 'email',
		'std' => '',
		'type' => 'text');
	$options[] = array(
		'name' => __('Phone No.', 'options_framework_theme'),
		'desc' => __('Enter Primary Number(no space you can use "-" instead)', 'options_framework_theme'),
		'id' => 'phone',
		'std' => '',
		'type' => 'text');
	$options[] = array(
		'name' => __('Telephone No.', 'options_framework_theme'),
		'desc' => __('Enter Telephone Number(no space you can use "-" instead)', 'options_framework_theme'),
		'id' => 'tel',
		'std' => '',
		'type' => 'text');
	$options[] = array(
		'name' => __('Address', 'options_framework_theme'),
		'desc' => __('Full Address', 'options_framework_theme'),
		'id' => 'address',
		'std' => '',
		'type' => 'textarea');


	//Social Media

	$options[] = array(
		'name' => __('Social Media', 'options_framework_theme'),
		'type' => 'heading' );

	$options[] = array(
		'name' => __('Facebook', 'options_framework_theme'),
		'desc' => __('It makes it easy for you to connect and share with your family and friends online', 'options_framework_theme'),
		'id' => 'facebook',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Twitter', 'options_framework_theme'),
		'desc' => __('Connect with people, express yourself and discover what is happening on Twitter. Join the global conversation.', 'options_framework_theme'),
		'id' => 'twitter',
		'std' => '',
		'type' => 'text');
	$options[] = array(
		'name' => __('Google Plus', 'options_framework_theme'),
		'desc' => __('You will see what your friends & family are sharing when you add them.', 'options_framework_theme'),
		'id' => 'google',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Youtube', 'options_framework_theme'),
		'desc' => __('Share your youtube channel', 'options_framework_theme'),
		'id' => 'youtube',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Linkedin', 'options_framework_theme'),
		'desc' => __('Share your linkedin profile', 'options_framework_theme'),
		'id' => 'linkedin',
		'std' => '',
		'type' => 'text');
	$options[] = array(
		'name' => __('Pinterest', 'options_framework_theme'),
		'desc' => __('Pint it', 'options_framework_theme'),
		'id' => 'pinterest',
		'std' => '',
		'type' => 'text');
	$options[] = array(
		'name' => __('Instagram', 'options_framework_theme'),
		'desc' => __('Share your instagram photos', 'options_framework_theme'),
		'id' => 'instagram',
		'std' => '',
		'type' => 'text');
	
	//Banner
	$options[] = array(
		'name' => __('Banner', 'options_framework_theme'),
		'type' => 'heading' );

	$options[] = array(
		'name' => __('Banner Image', 'options_framework_theme'),
		'desc' => __('Upload your banner image( size must be 1400 x 1020)', 'options_framework_theme'),
		'id' => 'banner',
		'type' => 'upload');
	$options[] = array(
		'name' => __('Home Banner Intro Text', 'options_framework_theme'),
		'desc' => __('Banner intro text', 'options_framework_theme'),
		'id' => 'intro',
		'std' => '',
		'type' => 'text');
	//Footer

	$options[] = array(
		'name' => __('Footer', 'options_framework_theme'),
		'type' => 'heading' );

	$options[] = array(
		'name' => __('Copyright', 'options_framework_theme'),
		'desc' => __('Enter Copyright', 'options_framework_theme'),
		'id' => 'copyright',
		'std' => '',
		'type' => 'text');

	//RSVP

	$options[] = array(
		'name' => __('RSVP', 'options_framework_theme'),
		'type' => 'heading' );

	$options[] = array(
		'name' => __('RSVP text', 'options_framework_theme'),
		'desc' => __('Enter Copyright', 'options_framework_theme'),
		'id' => 'rsvp_text',
		'std' => '',
		'type' => 'text');
	$options[] = array(
		'name' => __('RSVP link', 'options_framework_theme'),
		'desc' => __('Enter Copyright', 'options_framework_theme'),
		'id' => 'rsvp_link',
		'std' => '',
		'type' => 'text');

	//Videos

	$options[] = array(
		'name' => __('WEPN Videos', 'options_framework_theme'),
		'type' => 'heading' );
	$options[] = array(
		'name' => __('About Us Text', 'options_framework_theme'),
		'desc' => __('Enter Title', 'options_framework_theme'),
		'id' => 'video_about_text',
		'std' => '',
		'type' => 'text');
	$options[] = array(
		'name' => __('About Us Video', 'options_framework_theme'),
		'desc' => __('use iframe', 'options_framework_theme'),
		'id' => 'video_about',
		'std' => '',
		'type' => 'editor');
	$options[] = array(
		'name' => __('Benefits to Venues Text', 'options_framework_theme'),
		'desc' => __('Enter Title', 'options_framework_theme'),
		'id' => 'video_venue_text',
		'std' => '',
		'type' => 'text');
	$options[] = array(
		'name' => __('Benefits to Venues Video', 'options_framework_theme'),
		'desc' => __('use iframe', 'options_framework_theme'),
		'id' => 'video_venue',
		'std' => '',
		'type' => 'editor');
	$options[] = array(
		'name' => __('Benefits to Supplier Video Text', 'options_framework_theme'),
		'desc' => __('Enter Title', 'options_framework_theme'),
		'id' => 'video_diff_text',
		'std' => '',
		'type' => 'text');
	$options[] = array(
		'name' => __('Benefits to Supplier Video', 'options_framework_theme'),
		'desc' => __('use iframe', 'options_framework_theme'),
		'id' => 'video_diff',
		'std' => '',
		'type' => 'editor');
	$options[] = array(
		'name' => __('Blooper Text', 'options_framework_theme'),
		'desc' => __('Enter Title', 'options_framework_theme'),
		'id' => 'video_blooper_text',
		'std' => '',
		'type' => 'text');
	$options[] = array(
		'name' => __('Blooper Video', 'options_framework_theme'),
		'desc' => __('use iframe', 'options_framework_theme'),
		'id' => 'video_blooper',
		'std' => '',
		'type' => 'editor');

//Thank You Messages
	$options[] = array(
		'name' => __('Thank You Messages', 'options_framework_theme'),
		'type' => 'heading' );
	$options[] = array(
		'name' => __('Default Message', 'options_framework_theme'),
		'desc' => __('This will be sent mostly from main Contact Form', 'options_framework_theme'),
		'id' => 'message_primary',
		'std' => '',
		'type' => 'editor');
	$options[] = array(
		'name' => __('Secondary Message', 'options_framework_theme'),
		'desc' => __('This will be sent mostly from Venue, Supplier, Become a Member Form', 'options_framework_theme'),
		'id' => 'message_secondary',
		'std' => '',
		'type' => 'editor');

	return $options;
}