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
// Get all pinned reviews
$args = array(
  'number'  => 3,
  'post_id' => 0,
  'status'  => 'approve',
  'meta_query' => array(
    'relation' => 'AND',
    array(
      'key' => 'pinned',
      'value' => '',
      'type' => 'char',
      'compare' => '!='
    )
  )
);
$comments = get_comments($args);
$reviews = array();
$pinned_keys = array();
foreach($comments as $comment){
  $listed_comment = new stdClass();
  $listed_comment->id = $comment->comment_ID;
  $listed_comment->name = $comment->comment_author;
  $listed_comment->content = $comment->comment_content;
  $listed_comment->pinned = get_comment_meta($comment->comment_ID, 'pinned', true);
  $listed_comment->rating = get_comment_meta($comment->comment_ID, 'rating', true);
  array_push($reviews, $listed_comment);
  array_push($pinned_keys, $comment->comment_ID);
}
// Sort by pinned
if(count($reviews)>1){
  if(!function_exists('pinsort')){
    function pinsort($a,$b) {
      return $a->pinned>$b->pinned;
    }
  }
  uasort($reviews, "pinsort");
}

$args = array(
  'number'  => 3,
  'post_id' => 0,
  'orderby' => 'modified',
  'order'   => 'DESC',
  'status'  => 'approve'
);
$comments = get_comments($args);
$all_reviews = array();
foreach($comments as $comment){
  $listed_comment = new stdClass();
  $listed_comment->id = $comment->comment_ID;
  $listed_comment->name = $comment->comment_author;
  $listed_comment->content = $comment->comment_content;
  $listed_comment->rating = get_comment_meta($comment->comment_ID, 'rating', true);
  if($listed_comment->rating=='') $listed_comment->rating = 0;
  array_push($all_reviews, $listed_comment);
}

?>

<section class="bg-slate page-left page-right bumper-top-medium bumper-bottom-medium top-radius migrate">
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
			<ul id="reviews-list" class="reviews-list">
			<?php
			  global $review;
			  if(count($reviews)>0){
			    foreach($reviews as $review){
			      get_template_part('templates/list', 'review');
			    }
			  } elseif (count($all_reviews)>0){
			    foreach($all_reviews as $review){
			      if(!in_array($review->id, $pinned_keys)){
			        get_template_part('templates/list', 'review');
			      }
			    }
			  }
			?>
			</ul>
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
	
<?php get_footer(); ?>