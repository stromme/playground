<?php
/**
 * Name: Playground Theme Functions
 * Description: 
 * A blank theme used for testing the Toolbox Framework
 *
 * @package Playground
 * @author Hatch
 */
 
/* Define the environment we're working in. DEV or LIVE. Used for script loading. 
 * Should add a dynamic check here, maybe based on virtual host settings.
 * Both the theme and the Toolbox Framework rely on this constant.
 */
 
define( 'ENVIRONMENT', 'DEV' );

/* Init the Toolbox Framework
 * 
 */

define( 'TOOLBOX_BASE_DIR', 'toolbox-framework' );
require_once( trailingslashit( get_template_directory() ) . trailingslashit( TOOLBOX_BASE_DIR ) . 'toolbox.php' );
$Toolbox = new TB_Framework();

/* Load the theme JS.
 * Don't load theme JS in the context of the toolbox.
 *
 */

function hs_load_scripts() {
	
	if ( get_post_type() != 'toolbox' ) {
		
		// Force WP to latest version of JQuery by de-registering the version packaged with WP
		wp_deregister_script( 'jquery' );
		
		if ( ENVIRONMENT == 'LIVE' ) {

			// Load jquery from CDN in production environment
			
	 		wp_register_script( 'jquery', 'http://code.jquery.com/jquery-latest.js');
	 		wp_enqueue_script( 'jquery' );
	 		
	 		// Load Typekit for font management
	 		
	 		wp_register_script( 'typekit', 'http://use.typekit.net/aii7njo.js');
	 		wp_enqueue_script( 'typekit' );
	 		
	 		// This line needs to be fixed - echoing out is bad practice
	 		echo '<script type="text/javascript">try{Typekit.load();}catch(e){}</script>';
	 		
	 	} else {
	 		
	 		// Load jquery from localhost in development environment
	 		
			wp_register_script( 'jquery', get_bloginfo('template_url') . '/toolbox/js/jquery-latest.js');
			wp_enqueue_script( 'jquery' );
		}
	}
} 
add_action( 'wp_enqueue_scripts', 'hs_load_scripts' );

/* Load the theme CSS.
 * Don't load theme CSS in the context of the toolbox.
 *
 */
 
function hs_load_css() {
	
	if ( get_post_type() != 'toolbox' ) {
	
		wp_enqueue_style('theme-styles', get_bloginfo('template_url').'/main.css');
	}
} 
add_action( 'wp_enqueue_scripts', 'hs_load_scripts' );


?>