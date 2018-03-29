<?php
/**
 * Toolbox Header
 *
 *
 * @package WordPress
 * @subpackage Hatch
 * @since Hatch 1.0
 */

global $post;
$industry = get_option('tb_industry');
$blogs = array();
?><!DOCTYPE html>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-title" content="Toolbox" />
  <link rel="apple-touch-icon-precomposed" href="<?=TOOLBOX_IMAGES.'/apple-touch-icon.png'?>"/>
	<title>Toolbox | <?=ucwords($post->post_name)?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
  <!-- W3TC-include-css -->
  <!-- W3TC-include-js-head -->
	<?php wp_head(); ?>
	<?=get_google_analytics_code();?>
  <?php
  if(class_exists('Social')){
    $social = new Social();
    $social->process_pending_sharing();
  }
  ?>
  <script type="text/javascript">
    var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
  </script>
</head>

<body>

<!-- Urgent Alerts - fixed to top - default visibility hidden
    ================================================== -->	
<div class="alert-fixed-top container-fluid">
	<div id="alert">
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
    		$seo = get_location_seo();
    		if ( $industry['industry'] == 'window-cleaning' && isset($seo['city']) && $seo['city']!='') echo '<h2>' , $seo['city'] , ', ' , $seo['state'] , '</h2>'; else echo '<h2>Hatch</h2>';?></div>
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
					<li class="has-nav-icon hidden-phone">
						<a href="<?=TOOLBOX_URL?>ad-media"><i class="icon-nav-bullhorn"></i>Ad Media</a>
					</li>
					<li class="dropdown has-nav-icon control-panel-expanded">
						<a id="control-panel" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-nav-cog"></i> <b class="caret"></b></a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="control-panel">
              <?php
                if(!is_super_admin(get_current_user_id())){
                  $blogs = get_blogs_of_user(get_current_user_id());
                }
                else {
                  $owner = get_site_owner();
                  if(isset($owner->ID) && $owner->ID){
                    $blogs = get_blogs_of_user($owner->ID);
                    unset($owner);
                  }
                }
                if(count($blogs)>1){
                  usort($blogs, "compare_blogname");
                  echo "<li><ul>";
                  foreach($blogs as $blog){
                    if($blog->userblog_id!=get_current_blog_id()){
                      $blog_seo = get_blog_option($blog->userblog_id, 'tb_seo');
                      $city_state = '';
                      if($blog_seo!=''){
                        $city_state = stripslashes($blog_seo['seo_target_city']).(($blog_seo['seo_target_city']!='' && $blog_seo['seo_target_state'])?", ":"").$blog_seo['seo_target_state'];
                      }
                      if($city_state==''){
                        $blog_details = get_blog_details($blog->userblog_id);
                        $city_state = stripslashes(ucwords(str_replace('-', ' ', str_replace('/', ' ', trim($blog_details->path, '/')))));
                      }

              ?>
              <li><a tabindex="-1" href="<?=$blog->siteurl.'/toolbox/dashboard/'?>"><?=$city_state?> <small class="muted"> - Switch site</small></a></li>
              <?php
                    }
                  }
                  echo '</ul></li><li class="divider"></li>';
                }
              ?>
							<li><a tabindex="-1" href="<?=TOOLBOX_URL?>manage/profile/">Company Profile</a></li>
							<li><a tabindex="-1" href="<?=TOOLBOX_URL?>manage/sharing/">Sharing and Tracking</a></li>
              <li><a tabindex="-1" href="<?=TOOLBOX_URL?>manage/apps/">Add-on Apps</a></li>
              <li><a tabindex="-1" href="" class="request-edit-site">Request Update to Site</a></li>
							<li class="divider"></li>
							<li><a tabindex="-1" href="<?=TOOLBOX_URL?>manage/account/">Personal Profile</a></li>
              <?php
                $owner = get_site_owner();
                if(is_super_admin() || ($owner && isset($owner->ID) && $owner->ID==get_current_user_id())){
              ?>
              <li><a tabindex="-1" href="<?=TOOLBOX_URL?>manage/account-notifications/">Account Notifications</a></li>
              <?php } ?>
              <li><a tabindex="-1" href="<?=TOOLBOX_URL?>manage/account/?logout=1&nonce=<?=wp_create_nonce('logout-'.date('Ymd'))?>">Log out</a></li>
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
              if(count($blogs)>1){
                foreach($blogs as $blog){
                  if($blog->userblog_id!=get_current_blog_id()){
                    $blog_seo = get_blog_option($blog->userblog_id, 'tb_seo');
                    $city_state = '';
                    if($blog_seo!=''){
                      $city_state = $blog_seo['seo_target_city'].", ".$blog_seo['seo_target_state'];
                    }
                    if($city_state==''){
                      $blog_details = get_blog_details($blog->userblog_id);
                      $city_state = ucwords(str_replace('-', ' ', str_replace('/', ' ', trim($blog_details->path, '/'))));
                    }
          ?>
          <li><a tabindex="-1" href="<?=$blog->siteurl.'/toolbox/dashboard/'?>"><?=$city_state?></a></li>
          <?php
                  }
                }
                echo '<li class="divider"></li>';
              }
            }
          ?>
          <li><a tabindex="-1" href="<?=TOOLBOX_URL?>manage/profile">Company Profile</a></li>
          <li><a tabindex="-1" href="<?=TOOLBOX_URL?>manage/sharing/">Sharing and Tracking</a></li>
          <li><a tabindex="-1" href="<?=TOOLBOX_URL?>manage/apps/">Add-on Apps</a></li>
          <li class="visible-phone"><a tabindex="-1" href="<?=TOOLBOX_URL?>ad-media/">Ad Media</a></li>
          <li><a tabindex="-1" href="" class="request-edit-site">Request Update to Site</a></li>
          <li class="divider"></li>
          <li><a tabindex="-1" href="<?=TOOLBOX_URL?>manage/account/">Personal Profile</a></li><?php if(strstr($_SERVER['HTTP_HOST'], 'localhost') || strstr($_SERVER['HTTP_HOST'], 'uzbuz.com')){ ?>
          <li><a tabindex="-1" href="<?=TOOLBOX_URL?>manage/account-notifications/">Account Notifications</a></li><?php } ?>
          <li><a tabindex="-1" href="<?=TOOLBOX_URL?>manage/account/?logout=1&nonce=<?=wp_create_nonce('logout-'.date('Ymd'))?>">Log out</a></li>
        </ul>
      </div>
		</div>
	</div>
</div>