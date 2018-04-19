<!DOCTYPE html>
<html>
<head>
	<?php wp_head(); //HOOK. Required for plugins & the toolbar to work ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="<?php bloginfo('charset'); ?>">
	
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>">
</head>
<body <?php body_class(); ?> >
	<header class="header" style="background-image: url(<?php header_image(); ?>)" >
		<div class="header-bar">
			<?php the_custom_logo(); ?>
			<h1 class="site-title">
				<a href="<?php echo home_url(); ?>">
					<?php bloginfo( 'name' ); ?>	
				</a>
			</h1>
			<h2><?php bloginfo( 'description' ); ?></h2>

			<?php //Display a fancy menu location (don't forget to register it in the functions.php)
			wp_nav_menu( array(
				'theme_location' 	=> 'main_menu',
			 	'container' 		=> 'nav',				// div, nav, ""
			 	'container_class' 	=> 'main-nav-contain',	// nav class="main-nav-contain"
			 	'menu_class' 		=> 'main-menu',			// ul class="main-menu"
			 	'fallback_cb' 		=>  false,				// do nothing if no menu exists
			 ) );
			 ?>

			 <?php 
			//display the social media icons
			 wp_nav_menu( array(
			 	'theme_location' 	=> 'social_icons',
			 	'container_class' 	=> 'social-navigation',
			 	'link_before' 		=> '<span class="screen-reader-text">',
			 	'link_after' 		=> '</span>',
			 ) );
			 ?>

			 <?php /* default search form *OR* create a custom search form by adding searchform.php to your file */ get_search_form(); ?>

			 <a class="cart-customlocation" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
			 	<?php echo sprintf ( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?> - <?php echo WC()->cart->get_cart_total(); ?>
			 </a>


			</div>
		</header>
		<div class="wrapper">