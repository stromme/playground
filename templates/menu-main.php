<?php
/**
 * 
 * Description: Fixed to top page headline and call to action
 *
 * @package 
 * @subpackage 
 * @since 
 */

$services_terms = get_terms('services', array('hide_empty' => 1, 'orderby' => 'term_name', 'order' => 'ASC'));
$locations_terms = get_terms('locations', array('hide_empty' => 1, 'orderby' => 'term_name', 'order' => 'ASC'));
$i=0;
foreach ($services_terms as $key=>$service) {
  $desc = json_decode($service->description);
  $services_terms[$key]->order = ($desc && isset($desc->order))?($desc->order):$i;
  ++$i;
  unset($service);
}
uasort($services_terms, "compare_promote_order");
$i=0;
foreach ($locations_terms as $key=>$location) {
  $desc = json_decode($location->description);
  $locations_terms[$key]->order = ($desc && isset($desc->order))?($desc->order):$i;
  ++$i;
  unset($location);
}
uasort($locations_terms, "compare_promote_order");
$promoted_services = array();
foreach($services_terms as $term){
  $args = array(
    'post_type' => 'cftl-tax-landing',
    'services' => $term->slug,
    'numberposts' => 1
  );
  $promoted_posts = get_posts($args);
  if(count($promoted_posts)>0){
    unset($promoted_posts);
    $term->page_type = 'services';
    array_push($promoted_services, $term);
  }
  else {
    // Change the name, more descriptive
    $has_project_services = $term->slug;
    $args = array(
      'post_type'		=> 'showroom',
      'post_status'	=> 'publish',
      'numberposts' => 1,
      'posts_per_page'  => 1,
      'services'    => $has_project_services
    );
    $loop = new WP_Query( $args );
    $term_posts = $loop->posts;
    unset($loop);
    if(count($term_posts)>0){
      $term->page_type = 'showroom';
      array_push($promoted_services, $term);
    }
  }
}
/*$promoted_locations = array();
foreach($locations_terms as $term){
  $args = array(
    'post_type' => 'cftl-tax-landing',
    'locations' => $term->slug,
    'numberposts' => 1
  );
  $promoted_posts = get_posts($args);
  if(count($promoted_posts)>0){
    unset($promoted_posts);
    $term->link = get_home_url()."/locations/".$term->slug."/";
    array_push($promoted_locations, $term);
  }
}
// Add this member's sites to locations
$owner = get_site_owner();
$current_blog_id = get_current_blog_id();
if($owner && isset($owner->ID) && $owner->ID>0){
  $blogs = get_blogs_of_user($owner->ID);
  foreach($blogs as $user_blog){
    $term = new stdClass();
    $term->link = get_site_url($user_blog->userblog_id);
    $term->name = get_blog_name($user_blog->userblog_id);
    array_push($promoted_locations, $term);
  }
}*/

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
		<!-- Main Navigation Menu Bar -->
		<ul class="main-nav nav nav-pills fixed-nav">
			<li class="visible-desktop"><a href="<?=get_home_url()?>/">Home</a>
      <?php if(count($promoted_services)>0){ ?>
			<li class="dropdown hidden-desktop">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Services <b class="caret"></b></a>
				<ul class="dropdown-menu">
          <?php foreach($promoted_services as $service){ ?>
					<li><a href="<?=get_home_url()."/".$service->page_type."/".$service->slug?>/"><?=$service->name?></a></li>
          <?php } ?>
				</ul>
			</li>
      <? } /*if(count($promoted_locations)>0){ ?>
			<li class="dropdown visible-desktop"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Locations <b class="caret"></b></a>
				<ul class="dropdown-menu">
          <?php foreach($promoted_locations as $location){ ?>
					<li><a href="<?=trim($location->link, '/').'/'?>"><?=$location->name?></a></li>
          <?php } ?>
				</ul>
			</li>
      <? }*/ ?>
      <?php if(count($promoted_services)>0){ ?>
			<li class="dropdown visible-desktop">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">Services <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <?php foreach($promoted_services as $service){ ?>
          <li><a href="<?=get_home_url()."/".$service->page_type."/".$service->slug?>/"><?=$service->name?></a></li>
          <?php } ?>
        </ul>
			</li>
      <? } if(count($showroom)>0) { ?>
			<li class="hidden-phone"><a href="<?=get_home_url()."/showroom"?>">Showroom</a></li>
      <? } if(count($comments)>0) { ?>
			<li class="nav-callout nav-callout-border"><a href="<?=get_home_url()."/reviews"?>" class="clear-pills">Reviews</a><b class="nav-callout-border-notch notch"></b><b class="notch"></b></li>
      <? } ?>
			<li class="hidden-desktop"><button href="" class="btn btn-success btn-large quick-estimate <?=apply_filters('apply_responsibid', false);?>"><?=get_theme_mod('hs_cta_mobile_text', 'Estimate')?></button></li>
		</ul>
		<!-- /Main Navigation Menu Bar -->
		
	</nav>
	
	<!-- Brand -->
	<div class="brand fixed-brand">
    <span class="hide" itemprop="brand"><?php bloginfo( 'title' ); ?></span>
		<a href="<?=get_home_url()?>/"><span></span><img src="<?php echo get_header_image(); ?>" itemprop="logo"></a>
	</div>
	<!-- /Brand -->
	
</header>