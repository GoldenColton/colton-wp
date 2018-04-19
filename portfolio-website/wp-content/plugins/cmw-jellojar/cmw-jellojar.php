<?php
/*
Plugin Name: CMW JelloJar
Description: Adds a "hello-bar" style announcement to the top of the page
Author: Colton Wood
Version 0.1
License: Gplv3
 */

/**
 * HTML output for the bar
 */
add_action( 'wp_footer', 'cmw_jello_html' );
function cmw_jello_html() {
	?>
	<!-- Jello Jar Bar by Colton Wood -->
	<div id="jello-jar-bar" >
		<p>This is the text for my announcement bar</p>
		<a href="#" >- Click Here -</a>
		<a class="dismiss" >x</a>
	</div>
	<?php
}

/**
 * Attach all stylesheets and JS here v
 */
add_action( 'wp_enqueue_scripts', 'cmw_jello_scripts' );
function cmw_jello_scripts(){
	//attach stylesheet
	$css_url = plugins_url( 'css/jellojar.css', __File__ );
					// handle,		url,		dependancies,	version,
	wp_enqueue_style( 'jellojar', 	$css_url, 	array(),		'0.1' );

	//attach jquery
	wp_enqueue_script( 'jquery' );

	//attach our custom script
	$js_url = plugins_url( 'js/jellojar.js', __File__ );
					 // handle,			url,		dependancies,		version,	in footer?
	wp_enqueue_script( 'jellojar-js', 	$js_url, 	array( 'jquery' ), 	'0.1', 		true );

}




//no close php




