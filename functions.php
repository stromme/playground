<?php
/**
 * Name: Playground Theme Functions
 * Description: 
 * A blank theme used for testing the Toolbox Framework
 *
 * @package Playground
 * @author Hatch
 */

/* Make theme Toolbox framework compatible
/* ------------------------------------------------------------------------- */

/* Load the core theme framework. */
/* Sets the path to the parent theme directory. */
define( 'TOOLBOX_BASE_DIR', 'toolbox-framework' );
require_once( trailingslashit( get_template_directory() ) . trailingslashit( TOOLBOX_BASE_DIR ) . 'toolbox.php' );
$Toolbox = new TB_Framework();

/* Function to check if we're in the context of the Toolbox control panel */
function is_toolbox() {
	$is_toolbox = ( 'toolbox' == get_post_type() ? true : false );
	return $is_toolbox;	
}

/* ------------------------- */

add_action( 'after_setup_theme', 'hs_theme_setup' );
function hs_theme_setup() {	
	/* Load JavaScript files on the 'wp_enqueue_scripts' action hook. */
	$is_toolbox = is_toolbox();
	if ($is_toolbox != true) {
		// add_action( 'wp_enqueue_scripts', 'hs_load_scripts' );	
	}
}


function hs_load_scripts() {

	wp_enqueue_style('theme-styles', get_bloginfo('template_url').'/main.css');  
	
	/* Load the comment reply JavaScript. */
	if ( is_singular() && get_option( 'thread_comments' ) && comments_open() )
		wp_enqueue_script( 'comment-reply' );
} 




?>