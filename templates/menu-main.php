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

$services_terms = get_terms('services', array('hide_empty' => 1, 'orderby' => 'post_date', 'order' => 'DESC'));
$locations_terms = get_terms('locations', array('hide_empty' => 1, 'orderby' => 'post_date', 'order' => 'DESC'));

$promoted_services = array();
foreach($services_terms as $term){
  $args = array(
    'post_type' => 'cftl-tax-landing',
    'services' => $term->slug,
    'numberposts' => 1
  );
  $promoted_posts = get_posts($args);
  if(count($promoted_posts)>0){
    array_push($promoted_services, $term);
  }
}
$promoted_locations = array();
foreach($locations_terms as $term){
  $args = array(
    'post_type' => 'cftl-tax-landing',
    'locations' => $term->slug,
    'numberposts' => 1
  );
  $promoted_posts = get_posts($args);
  if(count($promoted_posts)>0){
    array_push($promoted_locations, $term);
  }
}
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
		<!--<div class="brand-phone clearfix">
			<?php $tb_company = get_option('tb_company'); ?>
			<h4><?=esc_html( stripslashes($tb_company['name']))?></h4>
		</div>-->
		<!-- /Text version  -->
		
		<!-- Main Navigation Menu Bar -->
		<ul class="main-nav nav nav-pills">
			<li class="visible-desktop"><a href="<?=get_home_url().$blog_prefix."/"?>">Home</a>
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
			<li class="hidden-phone"><a href="<?=get_home_url().$blog_prefix."/showroom"?>">Showroom</a></li>
      <? } if(count($comments)>0) { ?>
			<li class="nav-callout nav-callout-border"><a href="<?=get_home_url().$blog_prefix."/reviews"?>" class="clear-pills">Reviews</a><b class="nav-callout-border-notch notch"></b><b class="notch"></b></li>
      <? } ?>
			<li class="hidden-desktop"><button href="" class="btn btn-success btn-large quick-estimate">Estimate</button></li>
		</ul>
		<!-- /Main Navigation Menu Bar -->
		
	</nav>
	
	<!-- Brand -->
	<div class="brand">
		<a href="<?=get_home_url().$blog_prefix."/"?>"><img src="<?php echo get_header_image(); ?>"></a>
	</div>
	<!-- /Brand -->
	
</header>