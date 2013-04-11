<?php
/**
 * The Template for displaying all single posts.
 * For Hatch, this template will be used to display individual project posts. 
 *
 *
 * @package WordPress
 * @subpackage Hatch
 * @since 
 */

get_header();

$contact_id = get_post_meta($post->ID, 'customer_id', true);
$project_contact = get_contact_name($contact_id);
$project_location = get_contact_location($contact_id);
$prj = TB_Frontend::get_project_details($post);

?>

<section class="bg-slate">
	
	<div class="row-fluid bumper-top-large bumper-bottom single-project project">
		<div class="span6 page-left">
			<div class="img-polaroid favorite-photo">
        <img src="<?=$prj->favorite_media->image[0]?>" />
        <a href="<?=$prj->favorite_media->image_large[0]?>" class="colorbox-element" rel="gallery-<?=$prj->id?>"><i class="icon-fullscreen-2x"></i></a>
        <?php if($prj->media!='' && count($prj->media)>1){ ?>
          <div class="colorbox-image-list" style="display:none;">
            <?php foreach($prj->media as $media){ ?>
              <a href="<?=$media->image_large[0]?>" class="colorbox-element" <?=($prj->favorite_media->image[0]!=$media->image[0])?'rel="gallery-'.($prj->id).'"':''?>></a>
            <?php } ?>
          </div>
        <?php } ?>
			</div>
			<div class="curved-shadow">
				<img src="<?php echo THEME_IMAGES; ?>backgrounds/bottom-shadow.png" />
			</div>
			<ul class="thumbnails align-center bumper-top">
        <li>
          <a href="" class="thumbnail" data-image="<?=$prj->favorite_media->image[0]?>">
            <img src="<?=$prj->favorite_media->thumbnail?>" />
          </a>
        </li>
        <?php
          if($prj->media!='' && count($prj->media)>1){
            foreach($prj->media as $media){
              if($media->id!=$prj->favorite_media->id){ ?>
                <li>
                  <a href="" class="thumbnail" data-image="<?=$media->image[0]?>" data-image-large="<?=$media->image_large[0]?>">
                    <img src="<?=$media->thumbnail?>" />
                  </a>
                </li>
              <?php
              }
            }
          }
        ?>
			</ul>
		</div>
		<div class="span6 page-right">
			<p class="lead"><?=$prj->content?></p>
      <?php if($project_contact!='' || $project_location!=''){ ?>
			  <h3 class="bumper-top">
          <?php if($project_contact!=''){ ?><cite><?=$project_contact?></cite><?php } ?><?php if($project_location!=''){ ?><small>- <?=$project_location?></small><?php } ?>
        </h3>
			<?php } ?>
			<div class="bumper-top bumper-bottom">
				<div class="pen-stroke"></div>
			</div>
			
			<ul class="share-it">
				<li class="write-review"><a href=""><i class="icon-full-conversation"></i> Review this project</a></li>
				<!-- Commented out for local development -->
				<li class="social-network"><div class="fb-like" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false" data-font="verdana" data-action="like"></div></li>
				<li class="social-network"><a href="https://twitter.com/share" class="twitter-share-button" data-via="streakfreeclean" data-related="streakfreeclean" data-hashtags="WindowCleaning">Tweet</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></li>
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
  if($prj->term!=''){
    $term_name = strtolower($prj->term->name);
    $showroom_link .= '/'.$prj->term->slug;
    $post_args = $args;
    $post_args['services'] = $prj->term->slug;
  }
  $loop = new WP_Query( $post_args );
  $all_related_projects = $loop->posts;
  $related_projects = array();
  foreach($all_related_projects as $rel_prj){
    if(count($related_projects)<3){
      if($rel_prj->ID!=$prj->id){
        $new_project = TB_Frontend::get_project_details($rel_prj);
        array_push($related_projects, $new_project);
      }
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
        if($rel_prj->ID!=$prj->id){
          $new_project = TB_Frontend::get_project_details($rel_prj);
          array_push($related_projects, $new_project);
        }
      }
    }
  }
?>

<?php if(count($related_projects)>0){ ?>
<section class="bg-slate">
	<div class="row-fluid  bumper-top-medium bumper-bottom-medium">
		<div class="span12">
			<h2 class="blue center">View more of our recent <strong class="green"><?=$term_name?></strong> projects</h2>
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
							<a class="btn btn-primary btn-small" href="<?=$showroom_link?>">Visit Showroom</a> <a class="btn btn-success btn-small" href="<?=home_url().((get_blog_prefix()!='')?get_blog_prefix():'/')?>projects/<?=$rel_prj->slug?>">View project</a>
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