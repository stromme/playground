<?php
/**
 * Toolbox Header
 *
 *
 * @package WordPress
 * @subpackage Hatch
 * @since Hatch 1.0
 */
if(session_id() == '') {
  session_write_close();
  session_start();
}
global $post;
?><!DOCTYPE html>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-title" content="Hatch" />
	<link rel="apple-touch-icon" href="<?=get_theme_root_uri().'/'.get_stylesheet()?>/iphone-icon.png"/>
	<title>Toolbox | <?=ucwords($post->post_name)?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<?php wp_head(); ?>
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
    	<a class="brand hidden-phone" href="<?=TOOLBOX_URL?>dashboard">
    		<?php
    		$industry = get_option('tb_industry'); 
    		if ( $industry['industry'] == 'window-cleaning' ) echo '<img src="'. TOOLBOX_IMAGES . '/wc-logo.png">'; else echo '<h2>Hatch</h2>';?></a>
			<div><!--</div> class="nav-collapse collapse"-->
				<ul class="nav">
					<li class="has-nav-icon">
						<a href="<?=TOOLBOX_URL?>dashboard"><i class="icon-nav-dashboard"></i>Dashboard</a>
					</li>
					<li class="has-nav-icon">
            <a href="<?=TOOLBOX_URL?>promote"><i class="icon-nav-sun"></i>Promote</a>
					</li>
					<li class="has-nav-icon">
						<a href="<?=TOOLBOX_URL?>insight"><i class="icon-nav-compass"></i>Insight</a>
					</li>
					<li class="dropdown has-nav-icon control-panel-expanded">
						<a id="control-panel" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-nav-cog"></i> <b class="caret"></b></a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="control-panel">
							<li><a tabindex="-1" href="<?=TOOLBOX_URL?>manage/profile">Company Profile</a></li>
							<li><a tabindex="-1" href="<?=TOOLBOX_URL?>manage/media">Photos and Videos</a></li>
							<li><a tabindex="-1" href="<?=TOOLBOX_URL?>manage/sharing">Sharing</a></li>
							<li class="divider"></li>
							<li><a tabindex="-1" href="<?=TOOLBOX_URL?>manage/account">My account</a></li>
							<li><a tabindex="-1" href="<?=TOOLBOX_URL?>manage/logout?nonce=<?=wp_create_nonce('logout-'.date('Ymd'))?>">Log out</a></li>
						</ul>
					</li>
          <li class="control-panel-collapsed">
            <a href="#" role="button" data-toggle="collapse" data-target=".nav-collapse"><i class="icon-nav-cog"></i> <b class="caret"></b></a>
          </li>
					<li class="">
						<button class="btn btn btn-primary btn-project-shortcut action-new-project" type="button"><i class="icon-nav-edit"></i><span> New Project</span></button>
					</li>
				</ul>
			</div>
      <div class="nav-collapse collapse">
        <ul class="nav">
          <li><a tabindex="-1" href="<?=TOOLBOX_URL?>manage/profile">Company Profile</a></li>
          <li><a tabindex="-1" href="<?=TOOLBOX_URL?>manage/media">Photos and Videos</a></li>
          <li><a tabindex="-1" href="<?=TOOLBOX_URL?>manage/sharing">Sharing</a></li>
          <li class="divider"></li>
          <li><a tabindex="-1" href="<?=TOOLBOX_URL?>manage/account">My account</a></li>
          <li><a tabindex="-1" href="<?=TOOLBOX_URL?>manage/logout?nonce=<?=wp_create_nonce('logout-'.date('Ymd'))?>">Log out</a></li>
        </ul>
      </div>
		</div>
	</div>
</div>