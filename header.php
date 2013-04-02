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
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
</head>

<body>
<div id="fb-root"></div>
<!--<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=270342336310368";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>-->


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