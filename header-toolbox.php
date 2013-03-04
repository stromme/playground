<?php
/**
 * Toolbox Header
 *
 *
 * @package WordPress
 * @subpackage Hatch
 * @since Hatch 1.0
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
 
</head>

<body>


<!-- Urgent Alerts - fixed to top - default visibility hidden
    ================================================== -->	
<div class="alert-fixed-top container-fluid">
	<div class="offset2 span8" id="alert">
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">×</button>
		  	<strong>All done.</strong> We've saved your changes
		</div>
	</div>
</div>

<!-- Navbar
    ================================================== -->
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
    	<div class="container-fluid">
			<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
      <a class="brand" href="">Hatch</a>
			<div class="nav-collapse collapse">
				<ul class="nav">
					<li class="has-nav-icon">
						<a href="dashboard"><i class="icon-nav-dashboard"></i>Dashboard</a>
					</li>
					<li class="has-nav-icon">
						<a href="promote"><i class="icon-nav-sun"></i>Promote</a>
					</li>
					<li class="has-nav-icon">
						<a href="insight"><i class="icon-nav-compass"></i>Insight</a>
					</li>
					<li class="dropdown has-nav-icon">
						<a id="control-panel" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-nav-cog"></i> <b class="caret"></b></a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="control-panel">
							<li><a tabindex="-1" href="../manage/profile">Company Profile</a></li>
							<li><a tabindex="-1" href="../manage/media">Photos and Videos</a></li>
							<li><a tabindex="-1" href="../manage/preferences">Preferences</a></li>
							<li class="divider"></li>
							<li><a tabindex="-1" href="../manage/account">My account</a></li>
							<li><a tabindex="-1" href="../manage/billing">Log out</a></li>
						</ul>
					</li>
					<li class="">
						<button class="btn btn btn-primary btn-project-shortcut" type="button" id="new-project"><i class="icon-nav-edit"></i></button>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>