<?php 
/*
Plugin Name: CMW Admin Tweaks
Description: Customizing the admin panel, login screen and register screen
Author: Colton Wood
Author URI: Sample Author URI
Version: 0.1
License: GPLv3
*/


/**
 * Style the Login & Register Forms
 */
function cmw_login_style(){
	$url = plugins_url( 'css/login.css', __FILE__ );
	wp_enqueue_style( 'login.css', $url  );
}
add_action( 'login_enqueue_scripts', 'cmw_login_style' );

//change the href of teh login logo
function cmw_login_logo_href(){
	return home_url();
}
add_filter( 'login_headerurl', 'cmw_login_logo_href' );

//change the title of the login logo link
function cmw_login_logo_title(){
	return 'Return to the Home Page';
}
add_filter( 'login_headertitle', 'cmw_login_logo_title' );


/**
 * Remove unnecesary dashboard widgets
 */
function cmw_dashboard(){
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );

	//remove the "news" box for non-admin users
	if( ! current_user_can('manage_options') ):
		remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
	endif;

	//add our custom dashboard widget
	//$widget_id, $widget_name, $callback, $control_callback = null, $callback_args = null
	wp_add_dashboard_widget( 'cmw_dashboard_widget', 'My Custom Widget', 'cmw_dash_widget_content' );
}
add_action( 'wp_dashboard_setup', 'cmw_dashboard' );


//custom function for our dashboard widget content
function cmw_dash_widget_content(){
	?>
	<h2>Chillin Bruh:</h2>
	<iframe width="380" height="250" src="https://www.youtube.com/embed/DqPgURTYygQ" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
	<?php
}


/**
 * Add or remove items from the Toolbar (Admin bar)
 */
function cmw_toolbar( $wp_admin_bar ){
	//remove the WP logo and dropdown
	$wp_admin_bar->remove_node('wp-logo');

	//add a contact button
	$wp_admin_bar->add_node( array(
		'id' => 'cmw_contact',
		'title' => '<span class="ab-icon" style="top:2px;" ></span> Contact Me',
		'href' => 'mailto:goldencolton831@gmail.com',
	) );
}
add_action( 'admin_bar_menu', 'cmw_toolbar', 999 );