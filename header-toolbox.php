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
$industry = get_option('tb_industry');
?><!DOCTYPE html>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-title" content="Toolbox" />
	<link rel="apple-touch-icon-precomposed" href="<?=TOOLBOX_IMAGES?>/apple-touch-icon.png"/>
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
    	<div class="brand hidden-phone">
    		<?php 
    		if ( $industry['industry'] == 'window-cleaning' ) echo '<h2>'. get_bloginfo( 'name' ) . '</h2>'; else echo '<h2>Hatch</h2>';?></div>
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
              <?php
                if(!is_super_admin(get_current_user_id())){
                  $blogs = get_blogs_of_user(get_current_user_id());
                  if(count($blogs)>1){
                    function blogsort($a,$b) {
                      return strcmp($a->blogname, $b->blogname)>0;
                    }
                    usort($blogs, "blogsort");
                    foreach($blogs as $blog){
                      if($blog->userblog_id!=get_current_blog_id()){
              ?>
              <li><a tabindex="-1" href="<?=$blog->siteurl.((get_blog_prefix($blog->userblog_id))?get_blog_prefix($blog->userblog_id):'/').'toolbox/dashboard/'?>"><?=$blog->blogname?> <small class="muted"> - Switch site</small></a></li>
              <?php
                      }
                    }
                    echo '<li class="divider"></li>';
                  }
                }
              ?>
							<li><a tabindex="-1" href="<?=TOOLBOX_URL?>manage/profile">Company Profile</a></li>
							<li><a tabindex="-1" href="<?=TOOLBOX_URL?>manage/media">Photos and Videos</a></li>
							<li><a tabindex="-1" href="<?=TOOLBOX_URL?>manage/sharing">Sharing and Tracking</a></li>
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
          <?php
            if(!is_super_admin(get_current_user_id())){
              $blogs = get_blogs_of_user(get_current_user_id());
              if(count($blogs)>1){
                usort($blogs, "blogsort");
                foreach($blogs as $blog){
                  if($blog->userblog_id!=get_current_blog_id()){
          ?>
          <li><a tabindex="-1" href="<?=$blog->siteurl.((get_blog_prefix($blog->userblog_id))?get_blog_prefix($blog->userblog_id):'/').'toolbox/dashboard/'?>"><?=$blog->blogname?></a></li>
          <?php
                  }
                }
                echo '<li class="divider"></li>';
              }
            }
          ?>
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