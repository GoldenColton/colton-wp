<?php 
//custom image sizes
//				( Name, Width, Height, Will it crop ); 
add_image_size( 'banner', 1000, 500, true );
add_image_size( 'large_thumbnail', 300, 300, true );

// VVVV Support Featured Images VVVV 
add_theme_support( 'post-thumbnails' );

// VVVV Upgrade and HTML output to HTML5 VVVV 
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

// VVVV Delete the <title></title> tag from the header, then add this function VVVV 
add_theme_support( 'title-tag' );

// VVVV Customizer features VVVV 
add_theme_support( 'custom-background' );


//Custom Header
$args = array(
	'width' => 1000,
	'height' => 600,
	'flex-width' => true,
	'flex-height' => true,

);
add_theme_support( 'custom-header', $args );

//Custom Logo
$args = array(
	'width' => 200,
	'height' => 200,
	'flex-width' => true,
	'flex-height' => true,

);
add_theme_support( 'custom-logo', $args );

/**
 * Make editor-style.css
 */
add_editor_style();

/**
 * Change the default length of the_excerpt()
 * search results will show fewer words in the excerpts
 * @return int the number of words displayed in th excerpt
 */
function cmw_excerpt_length(){
	if( is_search() ):
		return 10;
	else:
		return 80;
	endif;
}
add_filter( 'excerpt_length', 'cmw_excerpt_length' );

function cmw_dotdotdot(){
	return '&hellip; <a href="' . get_permalink() . '" >Read More 💀🔪</a>';
}
add_filter( 'excerpt_more', 'cmw_dotdotdot' );

/**
 * Set up 3 menu locations
 * @since  0.1 added the function
 * @
 */
add_action( 'init', 'cmw_menu_locations' );
function cmw_menu_locations(){
	register_nav_menus( array(
		'main_menu' => 'Main Menu',
		'social_icons' => 'Social Media Icons',
		'footer_nav' => 'Footer Menu',
	) );
}

/**
 * enqueue all stylesheets or Javascript
 */
add_action( 'wp_enqueue_scripts', 'cmw_scripts' );
function cmw_scripts() {
	//style.css
	wp_enqueue_style( 'portfoliodo-style', get_stylesheet_uri() );

	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css' );
}



/**
 * Helper function to display archive or single pagination (next/prev buttons)
 */
function cmw_pagination(){
	if( is_singular() ):
		//single post pagination
		previous_post_link( '%link', '&larr; Previous: %title' );
		next_post_link( '%link', 'Next: %title, &rarr;' );
	else:
		//archive pagination
		if( wp_is_mobile() ):
			previous_posts_link( '&larr; Previous Page' );
			next_posts_link( 'Next Page &rarr;' );
		else:
			//numbered pagination
			the_posts_pagination( array(
				'mid_size' 	=> 2,
				'next_text' => 'Next Page &rarr;',
			) ); 
		endif;
	endif;
}

/**
 * Register the widget areas (dynamic sidebars)
 */
add_action( 'widgets_init', 'cmw_widget_areas' );

function cmw_widget_areas(){
	register_sidebar( array(
		'name' 			=> 'Blog Sidebar',
		'id' 			=> 'blog_sidebar',
		'description' 	=> 'Appears alongside the Blog and archive pages',
		'before_widget' => '<section class="widget %2$s" id="%1$s" >',
		'after_widget' 	=> '</section>',
		'before_title' 	=> '<h3 class="widget-title" >',
		'after_title' 	=> '</h3>',
	) );
	register_sidebar( array(
		'name' 			=> 'Footer Area',
		'id' 			=> 'footer_area',
		'description' 	=> 'Appears at the bottom of every screen/page',
		'before_widget' => '<section class="widget %2$s" id="%1$s" >',
		'after_widget' 	=> '</section>',
		'before_title' 	=> '<h3 class="widget-title" >',
		'after_title' 	=> '</h3>',
	) );
	register_sidebar( array(
		'name' 			=> 'Home Area',
		'id' 			=> 'home_area',
		'description' 	=> 'Appears at the bottom of every screen/page',
		'before_widget' => '<section class="widget %2$s" id="%1$s" >',
		'after_widget' 	=> '</section>',
		'before_title' 	=> '<h3 class="widget-title" >',
		'after_title' 	=> '</h3>',
	) );
	register_sidebar( array(
		'name' 			=> 'Shop Sidebar',
		'id' 			=> 'shop_sidebar',
		'description' 	=> 'Appears on all WOOcommerce pages',
		'before_widget' => '<section class="widget %2$s" id="%1$s" >',
		'after_widget' 	=> '</section>',
		'before_title' 	=> '<h3 class="widget-title" >',
		'after_title' 	=> '</h3>',
	) );
}

/**
 * Fix the Number of comments to only include REAL comments (not pingbacks or trackbacks)
 */
add_filter( 'get_comments_number', 'portfolio_comment_count' );
function portfolio_comment_count(){
	//get the current post id
	global $id;
	$comments = get_approved_comments( $id );
	$comment_count = 0;
	foreach ( $comments as $comment ) {
		//only count it if it is a "normal" comment
		if( $comment->comment_type == "" ){
			$comment_count++;
		}
	}
	return $comment_count;
}


/**
 * WOOcommerce Additions
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
	//edit this to match the element that wraps your Loop on a typical template
  echo '<main class="content" >';
}

function my_theme_wrapper_end() {
	//edit this to close properly
  echo '</main>';
}

//WOOcommerce support declaration - make the admin nag go away
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}



/**
 * Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php).
 * Used in conjunction with https://gist.github.com/DanielSantoro/1d0dc206e242239624eb71b2636ab148
 * Compatible with 3.0.1+, for lower versions, remove "woocommerce_" from the first mention on Line 4
 */
add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
 
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
	?>
	<a class="cart-customlocation" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
	<?php
	$fragments['a.cart-customlocation'] = ob_get_clean();
	return $fragments;
}

/**
 * Example of changing the content on the single product page
 * This will change the position of 
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 2 );


//no close php