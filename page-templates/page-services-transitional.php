<?php
/**
 * Template Name: Services Transitional
 * Description: The Template for displaying all services posts that have been transitioned from the old toolbox.
 *
 *
 * @package WordPress
 * @subpackage Hatch
 * @since 
 */

get_header();

?>

<section class="bg-slate page-left page-right">
	<div class="row-fluid">
	
		<div class="span8">
			
			<!-- Service page post content goes here -->
      <?php
      the_post();
      the_content();
      ?>
			
		</div>
		<div class="span4">
		
			<!-- Side bar content - We will add this after, will probably be a services list and maybe some accolades -->	
			
		</div>
	</div>
</section>

<?php
  $industry = get_option('tb_industry');
  $industry_name = str_replace("-", " ", $industry['industry']);
  $term_name = $industry_name;
  $showroom_link = home_url()."/showroom";
  $args = array(
    'orderby'		     => 'modified',
    'order'			     => 'DESC',
    'post_type'		   => array('showroom'),
    'post_status'	   => 'publish',
    'posts_per_page' => 4,
    'numberposts'    => 4
  );

  $terms = wp_get_post_terms($post->ID, "services");
  $term = $terms[0];
  if(isset($term)){
    $term_name = strtolower($term->name);
    $showroom_link .= '/'.$term->slug;
    $post_args = $args;
    $post_args['services'] = $term->slug;
  }
  $loop = new WP_Query( $post_args );
  $all_related_projects = $loop->posts;
  $related_projects = array();
  foreach($all_related_projects as $rel_prj){
    if(count($related_projects)<3){
      $new_project = TB_Frontend::get_project_details($rel_prj);
      array_push($related_projects, $new_project);
    }
  }

  // If there's no related project, then show default all project
  // And change the project category to all (the industry name)
  if(count($related_projects)<=0){
    $term_name = $industry_name;
    $loop = new WP_Query( $args );
    $all_related_projects = $loop->posts;
    $related_projects = array();
    foreach($all_related_projects as $rel_prj){
      if(count($related_projects)<3){
        $new_project = TB_Frontend::get_project_details($rel_prj);
        array_push($related_projects, $new_project);
      }
    }
  }
?>

<?php if(count($related_projects)>0){ ?>
<section class="bg-slate">
	<div class="row-fluid  bumper-top-medium bumper-bottom-medium">
		<div class="span12">
			<h2 class="blue center">Our recent <strong class="green"><?=$term_name?></strong> projects</h2>
		</div>
	</div>
	<div class="row-fluid">
		<ul class="thumbnails page-right page-left">
      <?php foreach($related_projects as $rel_prj){ ?>
			<li class="span4 bg-white">
				<div class="thumbnail">
          <div class="thumbnail-placeholder">
					  <img src="<?=$rel_prj->favorite_media->image[0]?>" />
          </div>
					<div class="caption">
						<p><?=(strlen($rel_prj->content)>120)?(substr($rel_prj->content, 0, 120).'...'):($rel_prj->content)?></p>
						<p>
							<a class="btn btn-primary btn-small" href="<?=$showroom_link?>">Visit Showroom</a><!-- <a class="btn btn-success btn-small" href="<?=home_url().((get_blog_prefix()!='')?get_blog_prefix():'/')?>projects/<?=$rel_prj->slug?>">View project</a>-->
						</p>
					</div>
				</div>
			</li>
      <?php  } ?>
		</ul>	
	</div>
</section>
<?php } ?>

<section class="bg-white">

	<!-- Accolades - Headline Style - Show one or more accolades (Carousel for multiple accolades)
	===============================================================================================
	-->
	
	<div class="row-middle center-align page-left page-right bumper-top bumper-bottom">
		<div class="middle-fixed-small bumper-right">		
			<img src="<?php echo THEME_IMAGES; ?>temp/angies.png" width="150">
		</div>
		<div class="middle">
			<h2> 2012 Angie's list superior service award winner.</h2>
		</div>
	</div>
	<div class="page-left page-right">
		<div class="pen-stroke"></div>
	</div>
	
	<!-- / Accolades -->
	
</section>
	
<?php get_footer(); ?>