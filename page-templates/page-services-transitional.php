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
$service_name = get_the_title();

$company = get_option('tb_company');
?>

<section class="bg-slate page-left page-right bumper-top-medium bumper-bottom-medium top-radius">
	<div class="row-fluid">
		<div class="span8">
			<div class="has-right-sidebar migrate">

			<!-- Service page post content goes here -->
			      <?php
			      the_post();
			      the_content();
			      ?>
			</div>
			<div class="clearfix"></div>

		</div>
		<div class="span4">
			<h3 class="blue">Customer Reviews</h3>
      <?php
        $featurette_reviews = apply_filters('cbtb_load_featurette_reviews', true);
        echo $featurette_reviews['display'];
      ?>
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
    'post_type'		   => 'showroom',
    'post_status'	   => 'publish',
    'posts_per_page' => 4,
    'numberposts'    => 4
  );

  $related_projects = array();
  $terms = wp_get_post_terms($post->ID, "services");
  if($terms && count($terms)>0){
    $term = $terms[0];
    $term_name = strtolower($term->name);
    $showroom_link .= '/'.$term->slug;
    $post_args = $args;
    $post_args['services'] = $term->slug;
    $loop = new WP_Query( $post_args );
    $all_related_projects = $loop->posts;
    unset($loop);

    if(count($all_related_projects)>0){
      foreach($all_related_projects as $rel_prj){
        if(count($related_projects)<3){
          $new_project = get_project_details($rel_prj);
          array_push($related_projects, $new_project);
        }
      }
      unset($all_related_projects);
    }
  }

  // If there's no related project, then show default all project
  // And change the project category to all (the industry name)
  if(count($related_projects)<=0){
    $service_name = "";
    $loop = new WP_Query( $args );
    $all_related_projects = $loop->posts;
    unset($loop);
    $related_projects = array();
    foreach($all_related_projects as $rel_prj){
      if(count($related_projects)<3){
        $new_project = get_project_details($rel_prj);
        array_push($related_projects, $new_project);
      }
      unset($all_related_projects);
    }
  }
?>

<?php if(count($related_projects)>0){ ?>
<section class="bg-white">
	<div class="row-fluid  bumper-top-medium bumper-bottom-medium">
		<div class="span12">
			<h2 class="blue center">Our recent <strong class="green"><?=strtolower($service_name)?></strong> projects</h2>
		</div>
	</div>
	<div class="row-fluid">
		<ul class="thumbnails page-right page-left">
      <?php foreach($related_projects as $rel_prj){ ?>
			<li class="span4 bg-white">
				<div class="thumbnail recent-projects">
          <div class="thumbnail-placeholder">
					  <img src="<?=$rel_prj->favorite_media->image_small[0]?>" />
          </div>
          <?php if(isset($rel_prj->reviews) && count($rel_prj->reviews)>0){ ?>
          <div class="customer-review">
            <h3>Customer reviewed</h3>
            <p>"<?=$rel_prj->reviews[0]->content?>"
            </p>
            <div class="author">
              <p><cite><?=$rel_prj->reviews[0]->name?></cite> &nbsp;<span class="review-rating" data-score="<?=$rel_prj->reviews[0]->rating?>"></span></p>
            </div>
          </div>
          <?php } ?>
					<div class="caption">
						<p><?=(strlen($rel_prj->content)>120)?(substr($rel_prj->content, 0, 120).'...'):($rel_prj->content)?></p>
            <a class="btn btn-primary btn-small" href="<?=$showroom_link?>" target="_blank">Visit Showroom</a>
					</div>
				</div>
			</li>
      <?php  } ?>
		</ul>	
	</div>
</section>
<?php } ?>
	
<?php get_footer(); ?>