<!-- Service area Module - List of locations serviced
=====================================================
-->

<?php
$users = get_users();
$owner_id = '';
$owner_name = '';
if(count($users)>0){
  foreach($users as $user){
    $roles = $user->roles;
    if(count($roles)>0){
      if($roles[0]=='owner'){
        $owner_id = $user->id;
        $owner_name = $user->display_name;
      }
    }
  }
}
$other_blog_locations = array();
if($owner_id!='' && $owner_id>0){
  $blogs = get_blogs_of_user($owner_id);
  if(count($blogs)>1){
    foreach($blogs as $user_blog){
      $current_blog_id = get_current_blog_id();
      if($user_blog->userblog_id!=$current_blog_id){
        switch_to_blog($user_blog->userblog_id);
      }
      $blog_seo = get_option('tb_seo');
      if($user_blog->userblog_id!=$current_blog_id){
        restore_current_blog();
      }
      if(isset($blog_seo)){
        if(isset($blog_seo['seo_target_city']) && isset($blog_seo['seo_target_state'])){
          $blog_seo_slug = strtolower(preg_replace("/[^A-Za-z0-9\_\-]/", '', $blog_seo['seo_target_city'])).'-'.strtolower($blog_seo['seo_target_state']);
          $args = array('post_type' => 'cftl-tax-landing', 'taxonomy' => 'locations', 'term' => $blog_seo_slug);
          $is_location_promoted = TB_Promote::is_promoted($args);
          $blog_seo_promoted_url = '';
          if($is_location_promoted) $blog_seo_promoted_url = home_url().get_blog_prefix().'locations/'.$blog_seo_slug;
          array_push($other_blog_locations, array(
            'name' => $blog_seo['seo_target_city'].', '.$blog_seo['seo_target_state'],
            'slug' => $blog_seo_slug,
            'promoted' => $is_location_promoted,
            'promoted_url' => $blog_seo_promoted_url
          ));
        }
      }
    }
  }
}
?>

<div>
	<h3 class="light-weight"><?=parse_shortclass($title)?></h3>
	<ul>
    <?php
      $locations = get_terms('locations', array('hide_empty' => 0));
      $seo_location_exists = array();
      if(count($locations)>0){
        foreach ($locations as $location) {
          $name = $location->name;
          $args = array('post_type' => 'cftl-tax-landing', 'taxonomy' => 'locations', 'term' => $location->slug);
          $is_location_promoted = TB_Promote::is_promoted($args);
          if($is_location_promoted){
            $name = '<a href="'.home_url().get_blog_prefix().'locations/'.($location->slug).'">'.$name.'</a>';
          }
          echo '<li>'.$name.'</li>';
          if(count($other_blog_locations)>0){
            foreach($other_blog_locations as $loc){
              if($loc['slug']==$location->slug){
                array_push($seo_location_exists, $loc['slug']);
              }
            }
          }
        }
      }
      if(count($other_blog_locations)>0){
        foreach($other_blog_locations as $loc){
          if(!in_array($loc['slug'], $seo_location_exists, true)){
            $name = $loc['name'];
            if($loc['promoted']){
              $name = '<a href="'.$loc['promoted_url'].'">'.$name.'</a>';
            }
            echo '<li>'.$name.'</li>';
          }
        }
      }
    ?>
	</ul>
</div>

<!-- / Service area -->