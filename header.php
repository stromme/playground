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
  <meta property="og:title" content="Test title"/>
  <meta property="og:url" content="Ttest url"/>
  <meta property="og:image" content="https://lh5.ggpht.com/qTjFRAkS4P-5Tfrr_ovb9CbpDcM2DQopnSMqZ_lzsWVLnK-2x649xbULVXma6ulLZido=w705"/>
  <meta property="og:site_name" content="Awesome site"/>
  <meta property="og:type" content="The type"/>
  <meta property="og:description" content="The description"/>
	<title><?php wp_title(); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
  <?=get_google_analytics_code();?>
  <?do_action('get_zopim_code');?>
</head>

<body itemscope itemtype="http://schema.org/ProfessionalService/">
<?php 

get_template_part('templates/menu', 'headline');
get_template_part('templates/menu', 'main');

?>

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
<?php do_action('output');
?>