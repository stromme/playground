<?php
/**
 * Template Name: Showroom
 * Description: 
 *
 * @package WordPress
 * @subpackage Hatch
 * @since 
 */

get_header(); 
// Get all pinned reviews

$terms = get_terms('services', array('hide_empty', true));
$service = get_query_var('service');
$service_name = '';
$new_terms = array();
if(count($terms)>0){
  foreach($terms as $term){
    $args = array(
      'post_type'		=> array('showroom'),
      'post_status'	=> 'publish',
      'numberposts' => 1,
      'posts_per_page'  => 1,
      'services'    => $term->slug
    );
    $loop = new WP_Query( $args );
    $term_posts = $loop->posts;
    if(count($term_posts)>0){
      array_push($new_terms, $term);
      if($service==$term->slug) $service_name = $term->name;
    }
  }
}
$terms = $new_terms;
$current_industry = get_option('tb_industry');
$industry_name = str_replace('-', ' ', $current_industry['industry']);
$current_service = ($service!='' && $service_name!='')?strtolower($service_name):'projects';

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
if($service_name!='') $args['services'] = $service;
$loop = new WP_Query( $args );
$pinned_projects = $loop->posts;
$pinned_keys = array();
foreach($pinned_projects as $prj){
  array_push($pinned_keys, $prj->ID);
  $new_project = get_project_details($prj);
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
if($service_name!='') $args['services'] = $service;
$loop = new WP_Query( $args );
$first_ten_projects = $loop->posts;
foreach($first_ten_projects as $prj){
  if(!in_array($prj->ID, $pinned_keys)){
    $new_project = get_project_details($prj);
    array_push($initial_projects, $new_project);
  }
}

?>

<!-- Wrap the page in .container to centre the content and keep it at a max width -->
<div class="container gentle-shadow top-radius">
	
	<section class="banner-title page-left page-right top-radius">
		<h2>
			See some of our recent 
			<span class="dropdown showroom-selector">
				<a href="" class="dropdown-toggle link-inverse link-decorate link-showoff" data-toggle="dropdown"><?=$current_service?></a>
		        <ul class="dropdown-menu">
		          <li class="triangle"></li>
		          <li class="show-text">Show...</li>
		          <?php if($service!=''){ ?>
		          <li><a href="<?=home_url().'/showroom'?>">All projects</a></li>
		          <?php } ?>
		          <?php foreach($terms as $term){ ?>
		          <li><a href="<?=home_url().'/showroom/'.$term->slug?>"><?=$term->name?></a></li>
		          <?php } ?>
		        </ul>
			</span>
    	<?php if ($current_service != 'projects') echo 'projects'; ?>
    	</h2>
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
      <div class="clearfix bumper-bottom-medium"></div>
    </div>
	</section>
</div>

<?php get_footer(); ?>
