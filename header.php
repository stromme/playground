<?php
/**
 * The Header for our theme.
 *
 * 
 *
 * @package Wordpress
 * @subpackage Hatch
 * @since 
 */
?>
<!DOCTYPE html>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php wp_title(); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
</head>

<body>

<? get_template_part('templates/menu', 'headline'); ?>
<? get_template_part('templates/menu', 'main'); ?>

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


<!-- Wrap the page in .container to centre the content and keep it at a max width -->
<div class="container gentle-shadow">