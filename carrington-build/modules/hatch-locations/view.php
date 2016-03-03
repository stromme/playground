<!-- Service area Module - List of locations serviced
=====================================================
-->
<?php
  $owner = get_site_owner();
  $blogs_list = array();
  $locations_list = array();
  $blog_seo_list = array();
  $current_blog_id = get_current_blog_id();

  if($owner && isset($owner->ID) && $owner->ID>0){
    $blogs = get_blogs_of_user($owner->ID);
    if(count($blogs)>0){
      foreach($blogs as $user_blog){
        if($user_blog->userblog_id==$current_blog_id){
          array_unshift($blogs_list, $user_blog->userblog_id);
        }
        else {
          array_push($blogs_list, $user_blog->userblog_id);
        }
      }
    }
  }
  else {
    array_push($blogs_list, $current_blog_id);
  }

  // Process the blog seo
  foreach($blogs_list as $user_blog){
    $blog_seo = get_blog_option($user_blog, 'tb_seo');
    if(isset($blog_seo['seo_target_city']) && isset($blog_seo['seo_target_state'])){
      $blog_seo_name = $blog_seo['seo_target_city'].(($blog_seo['seo_target_state']!='')?', '.$blog_seo['seo_target_state']:'');
      $blog_seo_slug = strtolower(preg_replace("/[^A-Za-z0-9\_\-]/", '-', $blog_seo['seo_target_city'])).'-'.strtolower($blog_seo['seo_target_state']);
      $new_blog_seo = new stdClass();
      $new_blog_seo->name = $blog_seo_name;
      $new_blog_seo->slug = $blog_seo_slug;
      $new_blog_seo->link = get_site_url($user_blog);
      array_push($blog_seo_list, $new_blog_seo);
    }
  }

  foreach($blogs_list as $user_blog){
    // Switch to blog if it's a different blog
    if($user_blog!=$current_blog_id) switch_to_blog($user_blog);
    $locations = get_terms('locations', array('hide_empty' => 0, 'orderby' => 'term_name', 'order' => 'ASC'));
    $i=0;
    foreach ($locations as $key=>$location) {
      $desc = json_decode($location->description);
      $locations[$key]->order = ($desc && isset($desc->order))?($desc->order):$i;
      ++$i;
      unset($location);
    }
    uasort($locations, "compare_promote_order");
    if($user_blog!=$current_blog_id) restore_current_blog();

    // Process those locations
    if(count($locations)>0){
      $current_blog_seo = get_option('tb_seo');
      $current_blog_seo_slug = (isset($current_blog_seo['seo_target_city']) && isset($current_blog_seo['seo_target_state']))?strtolower(preg_replace("/[^A-Za-z0-9\_\-]/", '-', $current_blog_seo['seo_target_city'])).'-'.strtolower($current_blog_seo['seo_target_state']):'';
      foreach($locations as $location) {
        $args = array('post_type' => 'cftl-tax-landing', 'taxonomy' => 'locations', 'term' => $location->slug, 'post_status' => 'publish');
        $is_location_promoted = TB_Promote::is_promoted($args);
        $loc_link = '';
        if($is_location_promoted){
          $loc_link = home_url().'/locations/'.($location->slug);
        }
        else if(count($blog_seo_list)>0) {
          $li_found = false;
          for($li=0;$li<count($blog_seo_list) && !$li_found;$li++){
            $blog_seo = $blog_seo_list[$li];
            if($blog_seo->slug==$location->slug || $blog_seo->name==$location->name){
              if($current_blog_seo_slug!=$location->slug) $loc_link = $blog_seo->link;
              $li_found = true;
            }
          }
          if(!$li_found) $loc_link = get_site_url($user_blog);
        }
        $new_blog_location = new stdClass();
        $new_blog_location->slug = $location->slug;
        $new_blog_location->name = $location->name;
        $new_blog_location->link = $loc_link;
        array_push($locations_list, $new_blog_location);
      }
    }
  }

  /* Remove already added blog seo list, the leftover */
  if(count($locations_list)>0){
    foreach($locations_list as $location){
      if(count($blog_seo_list)>0) {
        foreach($blog_seo_list as $bs_key=>$blog_seo){
          if($blog_seo->slug==$location->slug){
            unset($blog_seo_list[$bs_key]);
          }
        }
      }
    }
  }

  if(count($locations_list)>0){
?>
<h3 class="light-weight"><?=parse_shortclass($title)?></h3>
<ul>
  <?php
  // Sort it by name
  //uasort($locations_list, "compare_location_name");
    foreach($locations_list as $location){
  ?>
  <li><?=(($location->link)?"<a href=\"".$location->link."\">":"").$location->name.(($location->link)?"</a>":"")?></li>
  <?php
    }
    unset($locations_list);
  ?>
</ul>
<?php } ?>

<!-- / Service area -->