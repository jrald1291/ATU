<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=720">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
	<link rel="manifest" href="favicon/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!--[if lt IE 7]>
    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<div class="section-canvas"><!-- Canvas wrapper -->
	<div id="toggle-menu" class="toggle-menuwrapper">
		<button class="toggle-trigger">Open Menu</button>
		<?php
			$defaults = array(
				'theme_location'  => 'primary',
				'menu'            => '',
				'container'       => '',
				'container_class' => '',
				'container_id'    => '',
				'menu_class'      => 'nav toggle-menu navbar-right',
				'menu_id'         => '',
				'echo'            => true,
				'fallback_cb'     => 'wp_page_menu',
				'before'          => '',
				'after'           => '',
				'link_before'     => '',
				'link_after'      => '',
				'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s
					<li><a class="menu-item menu-item-type-custom menu-item-object-custom menu-item-15" data-toggle="modal" data-target=".form-venue">Search for Venue</a></li>
					<li><a class="menu-item menu-item-type-custom menu-item-object-custom menu-item-15" data-toggle="modal" data-target=".form-vendor">Search for Vendor</a></li>
				</ul>',
				'depth'           => 0,
				'walker'          => ''
			);

			wp_nav_menu( $defaults );
		?>		
	</div><!-- /toggle-menuwrapper -->
	<div class="l-wrapper"> <!-- Layout wrapper -->
		<div class="l-header">
			<div class="container">
				<div class="navbar navbar-default" role="navigation">
				    <div class="navbar-header">
				      <a class="navbar-brand" href="<?php echo get_home_url();?>">

					      <?php if(!of_get_option('logo_uploader', '')){?>
			                <img src="<?php echo get_template_directory_uri() ?>/images/logo.png" alt="">
			              <?php }else{ ?>
							<img src="<?php echo of_get_option('logo_uploader', ''); ?>" alt="">
			              <?php } ?>
				      	
				      </a>
				    </div>
				    <div class="navbar-collapse collapse">
				      <?php
						$defaults = array(
							'theme_location'  => 'primary',
							'menu'            => '',
							'container'       => '',
							'container_class' => '',
							'container_id'    => '',
							'menu_class'      => 'nav navbar-nav navbar-right cbp-tm-menu',
							'menu_id'         => 'nav-primary',
							'echo'            => true,
							'fallback_cb'     => 'wp_page_menu',
							'before'          => '',
							'after'           => '',
							'link_before'     => '',
							'link_after'      => '',
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'depth'           => 0,
							'walker'          => ''
						);

						wp_nav_menu( $defaults );
					?>
				    </div><!--/.nav-collapse -->
				</div>
			</div>
		</div>
		<div class="l-content">