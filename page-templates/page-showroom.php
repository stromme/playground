<?php
/**
 * Template Name: project
 * Description: 
 *
 * @package WordPress
 * @subpackage Hatch
 * @since 
 */

get_header(); 
// Get all pinned reviews

$initial_projects = array();
$args = array(
  'orderby' => 'pinned',
  'order'   => 'desc',
  'post_type'		   => array('showroom'),
  'post_status'	   => 'publish',
  'posts_per_page'  => -1,
  'meta_query' => array(
    array(
      'key' => 'pinned',
      'value' => '',
      'type' => 'char',
      'compare' => '!='
    )
  )
);
$loop = new WP_Query( $args );
$pinned_projects = $loop->posts;
$pinned_keys = array();
foreach($pinned_projects as $prj){
  array_push($pinned_keys, $prj->ID);
  $new_project = TB_Frontend::get_project_details($prj);
  array_push($initial_projects, $new_project);
}

$args = array(
  'orderby'		     => 'modified',
  'order'			     => 'DESC',
  'post_type'		   => array('showroom'),
  'post_status'	   => 'publish',
  'posts_per_page' => 10,
  'numberposts'    => 10
);
$loop = new WP_Query( $args );
$first_ten_projects = $loop->posts;
foreach($first_ten_projects as $prj){
  if(!in_array($prj->ID, $pinned_keys)){
    $new_project = TB_Frontend::get_project_details($prj);
    array_push($initial_projects, $new_project);
  }
}

?>

<!-- Wrap the page in .container to centre the content and keep it at a max width -->
<div class="container gentle-shadow">
	
	<section class="bg-sea margin-left margin-right page-title">
		<div class="bumper-top-medium bumper-bottom-medium center">
			<h2 class="white">See some of our recent <a href="" class="link-inverse link-decorate link-showoff">home window cleaning</a> projects</h2>
		</div>
	</section>
	<section class="bg-white" id="showroom">
		<div id="projects-list" class="row-fluid">
      <?php global $prj; ?>
      <div class="span4 showroom-column" data-column="0">
      <?php
        $i=0;
        foreach($initial_projects as $prj){
          if($i%3==0){
            load_template( dirname(__FILE__).'/../templates/list-project.php', false);
          }
          $i++;
        }
      ?>
      </div>
      <div class="span4 showroom-column" data-column="1">
      <?php
        $i=0;
        foreach($initial_projects as $prj){
          if($i%3==1){
            load_template( dirname(__FILE__).'/../templates/list-project.php', false);
          }
          $i++;
        }
      ?>
      </div>
      <div class="span4 showroom-column" data-column="2">
      <?php
        $i=0;
        foreach($initial_projects as $prj){
          if($i%3==2){
            load_template( dirname(__FILE__).'/../templates/list-project.php', false);
          }
          $i++;
        }
      ?>
      </div>
      <div class="clearfix"></div>
    </div>
	</section>
</div>

<?php get_footer(); ?>
