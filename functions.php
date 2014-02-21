<?php
/**
 * Name: Playground Theme Functions
 * Description: Master Hatch Theme
 *
 * @package Playground
 * @author Hatch
 */
 
/* Define working environment
 *
 * @since 0.1.0 
 */

$whitelist = array('127.0.0.1', '::1');
if ( !in_array($_SERVER['REMOTE_ADDR'], $whitelist) ) {
   define( 'ENVIRONMENT', 'LIVE' );
} else {
   define( 'ENVIRONMENT', 'DEV' );
}

/* Init the Toolbox Framework
 *
 * @since 0.0.1 
 */
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
		
		// Load Bootstrap Framework
		wp_register_script( 'theme-bootstrap-js', THEME_JS . 'bootstrap-min.js', array('jquery'));
		wp_enqueue_script( 'theme-bootstrap-js' );

		if ( ENVIRONMENT == 'LIVE' ) {
	 		
	 		// Load Typekit for font management
	 		
	 		wp_register_script( 'typekit', 'http://use.typekit.net/cdw0wlx.js');
	 		wp_enqueue_script( 'typekit' );
	 		
	 		add_action('wp_head', 'try_typekit');
	 		
	 		// Load Facebook
	 		
	 		add_action('wp_footer', 'hs_facebook');
	 		
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

/**
 * Add sitemap xml to sitemap index
 *
 * @return string
 */
function yoast_add_sitemap_index(){
  $base          = $GLOBALS['wp_rewrite']->using_index_permalinks() ? 'index.php/' : '';
  $blog_details = get_blog_details();
  $sitemap  = '';
  $services = get_terms('services', array('hide_empty'=>0));
  $exist = false;
  if(count($services)>0){
    foreach($services as $service){
      $posts = get_posts(
        array(
          'post_type' => 'showroom',
          'posts_per_page'   => 1,
          'numberposts'   => 1,
          'services' => $service->slug
        )
      );
      if(count($posts)>0){
        $exist = true;
        break;
      }
    }
    if($exist){
      $sitemap .= '<sitemap>' . "\n";
      $sitemap .= '<loc>' . home_url( $base . 'hatch-showroom-sitemap.xml' ) . '</loc>' . "\n";
      $sitemap .= '<lastmod>' . htmlspecialchars(date('c', strtotime($blog_details->registered))) . '</lastmod>' . "\n";
      $sitemap .= '</sitemap>' . "\n";
    }
  }
  return $sitemap;
}

/**
 * Sitemap for showroom
 */
function yoast_sitemap_hatch_showroom_xml(){
  $wpseo_sitemap = new WPSEO_Sitemaps();
  $services = get_terms('services', array('hide_empty'=>0));
  $output = '';
  foreach($services as $service){
    $posts = get_posts(
      array(
        'post_type' => 'showroom',
        'posts_per_page'   => 1,
        'numberposts'   => 1,
        'services' => $service->slug
      )
    );
    if(count($posts)>0){
      $output .= $wpseo_sitemap->sitemap_url( array(
        'loc' => trailingslashit(home_url().'/showroom/'.$service->slug),
        'pri' => 0.8,
        'chf' => 'weekly',
        'mod' => date('c', strtotime($posts[0]->post_date))
      ));
    }
  }
  $sitemap = '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" ';
  $sitemap .= 'xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" ';
  $sitemap .= 'xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
  $sitemap .= $output;
  $sitemap .= '</urlset>';
  $wpseo_sitemap->set_sitemap($sitemap);
  $wpseo_sitemap->output();
  exit;
}

/**
 * Additional sitemap for yoast sitemap
 */
function yoast_sitemap_mod(){
  global $wpseo_sitemaps;
  if($wpseo_sitemaps){
    global $rewrite;
    add_filter('wpseo_sitemap_index', 'yoast_add_sitemap_index', false);
    // Hatch showroom sitemap
    $wpseo_sitemaps->register_sitemap('hatch-showroom', 'yoast_sitemap_hatch_showroom_xml', $rewrite);
  }
}
add_action( 'init', 'yoast_sitemap_mod' );

?>