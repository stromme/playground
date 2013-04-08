<?php
/**
 * 
 * Description: Fixed to top page headline and call to action
 *
 * @package 
 * @subpackage 
 * @since 
 */

$blog_prefix = '';
if ( is_multisite() && !is_subdomain_install() && is_main_site() )
  $blog_prefix = '/blog';

$promoted_services = get_terms('services', array('hide_empty' => 1, 'orderby' => 'post_date', 'order' => 'DESC'));
$promoted_locations = get_terms('locations', array('hide_empty' => 1, 'orderby' => 'post_date', 'order' => 'DESC'));
$args = array(
  'orderby'		  => 'modified',
  'order'			  => 'DESC',
  'post_type'		=> array('showroom'),
  'post_status'	=> 'publish',
  'numberposts' => 1
);
$showroom = get_posts($args);
$args = array(
  'comment_approved' => 0,
  'number'           => 1
);
$comments = get_comments($args);
?>


<!-- Header
==================================================
-->
<header class="container">
	<nav>
		
		<!-- Text version of company name replaces logo on Phones -->
		<div class="brand-phone clearfix">
			<h4>Company Name</h4>
		</div>
		<!-- /Text version  -->
		
		<!-- Main Navigation Menu Bar -->
		<ul class="main-nav nav nav-pills">
      <?php if(count($promoted_services)>0){ ?>
			<li class="dropdown hidden-desktop"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Services <b class="caret"></b></a>
				<ul class="dropdown-menu">
          <?php foreach($promoted_services as $service){ ?>
					<li><a href="<?=get_home_url().$blog_prefix."/services/".$service->slug?>"><?=$service->name?></a></li>
          <?php } ?>
				</ul>
			</li>
      <? } if(count($promoted_locations)>0){ ?>
			<li class="dropdown visible-desktop"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Locations <b class="caret"></b></a>
				<ul class="dropdown-menu">
          <?php foreach($promoted_locations as $location){ ?>
					<li><a href="<?=get_home_url().$blog_prefix."/locations/".$location->slug?>"><?=$location->name?></a></li>
          <?php } ?>
				</ul>
			</li>
      <? } ?>
      <?php if(count($promoted_services)>0){ ?>
			<li class="dropdown visible-desktop"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Services <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <?php foreach($promoted_services as $service){ ?>
          <li><a href="<?=get_home_url().$blog_prefix."/services/".$service->slug?>"><?=$service->name?></a></li>
          <?php } ?>
        </ul>
			</li>
      <? } if(count($showroom)>0) { ?>
			<li class=" visible-desktop"><a href="<?=get_home_url().$blog_prefix."/showroom"?>">Showroom</a></li>
      <? } if(count($comments)>0) { ?>
			<li class="nav-callout nav-callout-border"><a href="<?=get_home_url().$blog_prefix."/reviews"?>" class="clear-pills">Reviews</a><b class="nav-callout-border-notch notch"></b><b class="notch"></b></li>
      <? } ?>
			<li class="hidden-desktop"><button href="" class="btn btn-success btn-large quick-estimate">Estimate</button></li>
		</ul>
		<!-- /Main Navigation Menu Bar -->
		
	</nav>
	
	<!-- Brand -->
	<div class="brand">
		<img src="<?php echo get_header_image(); ?>">
	</div>
	<!-- /Brand -->
	
</header>