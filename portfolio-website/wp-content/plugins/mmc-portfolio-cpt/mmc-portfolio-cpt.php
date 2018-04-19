<?php 
/*
Plugin Name: MMC Portfolio CPT
Description: Creates the "Portfolio" Custom Post Type, so we can add portfolio pieces
Author: Melissa Cabral
Version: 0.1
License: GPLv3
*/

add_action( 'init', 'mmc_register_stuff' );
function mmc_register_stuff(){
	register_post_type( 'portfolio_piece', array(
		'public' 		=> true,
		'has_archive' 	=> true,
		'label' 		=> 'Portfolio',
		'menu_icon'		=> 'dashicons-format-gallery',
		'menu_position'	=> 5,
		'labels'		=> array(
				'add_new_item' 	=> 'Add New Portfolio Piece',
				'not_found' 	=> 'No Portfolio Pieces Found',
			),
		//for better looking URLs, like site.com/portfolio
		'rewrite'		=> array( 'slug' => 'portfolio' ),
		'supports'		=> array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions',
								 'custom-fields' ),
	) );

	//add the "type of work" taxonomy to the portfolio
	register_taxonomy( 'type_of_work', 'portfolio_piece', array(
		'label' 			=> 'Work Types',
		'show_admin_column' => true,
		'hierarchical' 		=> true,
		'labels'			=> array(
				'add_new_item' 	=> 'Add New Work Type',
				'search_items' 	=> 'Search Work Types',
				'parent_item' 	=> 'Parent Work Type',
			),
	) );
}

function mmc_cpt_flush(){
	mmc_register_stuff();
	flush_rewrite_rules();
}
//run the function when this plugin activates
register_activation_hook( __FILE__, 'mmc_cpt_flush' );