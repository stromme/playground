<?php
/**
 * Name: Playground Theme Functions
 * Description: 
 * A blank theme used for testing the Toolbox Framework
 *
 * @package Playground
 * @author Hatch
 */
 
/* Init the Toolbox Framework
 *
 * @since 0.0.1 
 */

/* Define the environment we're working in. DEV or LIVE. */
define( 'ENVIRONMENT', 'DEV' );
define( 'TOOLBOX_BASE_DIR', trailingslashit( get_template_directory() ) . 'toolbox-framework' );
require_once( trailingslashit( TOOLBOX_BASE_DIR ) . 'toolbox.php' );
$Toolbox = new TB_Framework();
include_once(trailingslashit(TEMPLATEPATH) . 'carrington-build/carrington-build.php');

/* Theme Constants
 * 
 * @since 0.0.1
 */
function hs_constants() {
	
	/* Sets the path to the images directory. */ 
	define( 'THEME_IMAGES', get_bloginfo('template_directory').'/images/' );
	
	/* Sets the path to the js directory. */ 
	define( 'THEME_JS', get_bloginfo('template_directory').'/js/' );
	
	/* Sets the path to the css directory. */ 
	define( 'THEME_CSS', get_bloginfo('template_directory').'/css/' );

}

add_action('init', 'hs_constants');


/* Load the theme JS.
 * Don't load theme JS in the context of the toolbox.
 *
 */
function hs_load_scripts() {
	
	if ( get_post_type() != 'toolbox' ) {
		
		// Force WP to latest version of JQuery by de-registering the version packaged with WP
		wp_deregister_script( 'jquery' );
		
		// Load Bootstrap Framework
		wp_register_script( 'theme-bootstrap-js', THEME_JS . 'bootstrap-min.js', array('jquery'));
		wp_enqueue_script( 'theme-bootstrap-js' );
		
		// Load Typekit for font management
		
		wp_register_script( 'typekit', 'http://use.typekit.net/cdw0wlx.js');
		wp_enqueue_script( 'typekit' );

		add_action('wp_head', 'try_typekit');
		
		// Load Facebook
		
		add_action('wp_footer', 'hs_facebook');
		
		if ( ENVIRONMENT == 'LIVE' ) {

			// Load jquery from CDN in production environment
			
	 		wp_register_script( 'jquery', 'http://code.jquery.com/jquery-latest.js');
	 		wp_enqueue_script( 'jquery' );
	 		
	 		// Load Typekit for font management
	 		
	 		wp_register_script( 'typekit', 'http://use.typekit.net/cdw0wlx.js');
	 		wp_enqueue_script( 'typekit' );
	 		
	 		add_action('wp_head', 'try_typekit');
	 		
	 		// Load Facebook
	 		
	 		add_action('wp_footer', 'hs_facebook');
	 		
	 	} else {
	 		
	 		// Load jquery from localhost in development environment
	 		
			wp_register_script( 'jquery', get_bloginfo('template_url') . '/toolbox-framework/js/jquery-latest.js');
			wp_enqueue_script( 'jquery' );
		}
	}
} 

add_action( 'wp_enqueue_scripts', 'hs_load_scripts' );

/* Load Typekit
 *
 *
 */
 
function try_typekit(){
	echo '<script type="text/javascript">try{Typekit.load();}catch(e){}</script>';
}

/* Load Facebook Like Button
 *
 *
 */
 
function hs_facebook(){
	echo '
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.async=true; js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=270342336310368";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, \'script\', \'facebook-jssdk\'));</script>';
}


/* Load the theme CSS.
 * Don't load theme CSS in the context of the toolbox.
 *
 */
 
function hs_load_css() {

	// Prevent theme CSS from loading in the context of the Toolbox

	if ( get_post_type() != 'toolbox' ) {

		wp_enqueue_style('theme-styles', get_bloginfo('template_url').'/css/theme-min.css');
		wp_enqueue_style('theme-bootstrap-responsive', get_bloginfo('template_url').'/css/theme-responsive.css');
	}
}
add_action( 'wp_enqueue_scripts', 'hs_load_css' );

?>