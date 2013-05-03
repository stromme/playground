<?php
/**
 * Template Name: Home Transitional
 * Description: The Template for displaying home page that have been transitioned from the old toolbox.
 *
 *
 * @package WordPress
 * @subpackage Hatch
 * @since
 */

get_header();
$service_name = get_the_title();

$tb_company = get_option('tb_company');
$seo = get_location_seo();
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

$transitional_accolades = array(
  'awards' => array('name' => 'Awards', 'content' => array()),
  'news' => array('name' => 'News', 'content' => array()),
  'certifications' => array('name' => 'Certifications', 'content' => array()),
  'guarantees' => array('name' => 'Guarantees', 'content' => array())
);
$args = array(
  'post_type' => array('accolades'),
  'numberposts' => -1,
  'post_status' => 'published',
  'post_parent' => 0,
  'orderby'        => 'post_date',
  'order'          => 'DESC'
);
// Do get it
$accolades_post = get_posts($args);
if($accolades_post && count($accolades_post)>0){
  foreach($accolades_post as $ac){
    $terms = wp_get_post_terms($ac->ID, 'accolade-types');
    $accolade_image = '';
    if(gettype($terms)=='array' && $terms && count($terms)>0){
      if(count($terms)>1){
        $parent_slug = '';
        foreach($terms as $term){
          if(isset($transitional_accolades[$term->slug])) $parent_slug = $term->slug;
        }
        if($parent_slug!=''){
          $acc_term  = "";
          foreach($terms as $term){
            if($term->slug!=$parent_slug) $acc_term = $term->slug;
          }
          if($acc_term!='') $accolade_image = TOOLBOX_IMAGES.'/accolades/'.$acc_term.'.png';
          if(!file_exists(TOOLBOX_BASE_DIR.'/images/accolades/'.$acc_term.'.png')) $accolade_image = '';
          $args = array(
            'post_type' => 'attachment',
            'numberposts' => 1,
            'post_status' => 'any',
            'post_parent' => $ac->ID
          );
          $attachments = get_posts($args);
          $desc = get_post_meta($ac->ID, 'description', true);
          if($attachments) {
            $attachment = $attachments[0];
            $image = wp_get_attachment_image_src($attachment->ID, 'full');
            $accolade_image = $image[0];
          }
          array_push($transitional_accolades[$parent_slug]['content'], array(
            'id' => $ac->ID,
            'title' => $ac->post_title,
            'link' => $ac->post_content,
            'description' => $desc,
            'image' => $accolade_image,
            'term' => $acc_term
          ));
        }
      }
      else {
        $args = array(
          'post_type' => 'attachment',
          'numberposts' => 1,
          'post_status' => 'any',
          'post_parent' => $ac->ID
        );
        $attachments = get_posts($args);
        $desc = get_post_meta($ac->ID, 'description', true);
        if($attachments) {
          $attachment = $attachments[0];
          $image = wp_get_attachment_image_src($attachment->ID, 'full');
          $accolade_image = $image[0];
        }
        array_push($transitional_accolades[$terms[0]->slug]['content'], array(
          'id' => $ac->ID,
          'title' => $ac->post_title,
          'link' => $ac->post_content,
          'description' => $desc,
          'image' => $accolade_image,
          'term' => ""
        ));
      }
    }
  }
}
?>

<!-- Wrap the page in .container to centre the content and keep it at a max width -->
<div class="container gentle-shadow">

  <!-- Banner -->
  <section class="bg-white">
    <?php
    $banner_id = "home_transitional_banner";
    $args = array(
      'numberposts' => 3,
      'post_type'   => 'showroom',
      'post_status' => 'publish',
      'post_parent' => null,
      'order'       => 'ASC'
    );
    $posts_args = $args;
    $posts_args['meta_key'] = 'featured';
    $posts_args['orderby'] = 'featured';
    $projects = get_posts($posts_args);
    if(count($projects)<=0){
      $args['order'] = 'DESC';
      $projects = get_posts($args);
    }
    $js_data = array();
    if(count($projects)>0){
      $i = 0;
      foreach($projects as $project){
        $cust_id = get_post_meta($project->ID, 'customer_id', true);
        $favorite = get_post_meta($project->ID, 'favorite', true);
        $name = '';
        $city = '';
        $args = array(
          'numberposts' => -1,
          'post_type' => 'attachment',
          'post_parent' => $project->ID
        );
        $attachments = get_posts($args);
        $args = array(
          'numberposts' => -1,
          'post_type' => 'videos',
          'post_parent' => $project->ID
        );
        $videos = get_posts($args);
        if(count($attachments)>0){
          $medias = $attachments;
          if(count($videos)>0)
            array_merge($medias, $videos);
        }
        else {
          $medias = $videos;
        }
        $selected_medias = array();
        // Add favorite first
        foreach($medias as $media){
          if($media->ID==$favorite){
            array_push($selected_medias, $media);
            break;
          }
        }
        foreach($medias as $media){
          if($media->ID!=$favorite){
            array_push($selected_medias, $media);
          }
        }
        $project_media = array();
        foreach($selected_medias as $media){
          if($media->post_type=='videos'){
            $video_image = get_post_meta($media->ID, 'video_thumbnail', true);
            array_push($project_media, $video_image);
          }
          else {
            $_img = wp_get_attachment_image_src($media->ID, 'banner', false);
            array_push($project_media, $_img[0]);
          }
        }
        $private = 0;
        if($cust_id!=''){
          $contact = get_post($cust_id);
          $first_name = get_post_meta($contact->ID, 'first_name', true);
          $last_name = get_post_meta($contact->ID, 'last_name', true);
          $city = get_post_meta($contact->ID, 'city', true);
          $company = get_post_meta($contact->ID, 'company', true);
          $private = get_post_meta($contact->ID, 'make_private', true);
          $name = ($company!='')?
                    $company:
                    (($first_name!='' && $last_name!='')?
                      $first_name.' '.$last_name:
                      (($first_name!='')?
                        $first_name:
                        (($last_name!='')?$last_name:'')));
        }
        if($i==0){
          $description = $project->post_content;
          $author = $name;
          $author_location = $city;
          $image = $project_media[0];
        }

        $js_single_data = new stdClass();
        $js_single_data->id = $project->ID;
        $js_single_data->description = parse_shortclass($project->post_content);
        $js_single_data->author = parse_shortclass($name);
        $js_single_data->author_location = parse_shortclass($city);
        $js_single_data->images = $project_media;
        $js_single_data->video = '';
        $js_single_data->is_private = ($private==1)?true:false;
        array_push($js_data, $js_single_data);
        $i++;
      }
    }
    if(count($js_data)>0){
    ?>
    <div id="<?=$banner_id?>" class="carousel-<?=$banner_id?> banner" class="top-radius">
      <?php if(count($js_data)>1){ ?>
      <div class="carousel-inner">
      <?php } ?>
        <?php
          $i = 0;
          foreach($js_data as $d){
            if(count($js_data)>1){
        ?>
        <div class="<?=($i==0)?'active ':''?>item">
          <?php } ?>
          <div class="banner-photo">
            <?php if($d->video!=''){?>
              <?=parse_embed_video_link($d->video)?>
            <?php } else { ?>
              <img src="<?=$d->images[0]?>" />
            <?php } ?>
          </div>
          <div class="banner-review">
            <blockquote>
              <?php $description = substr($d->description, 0, 180)."..."; ?>
              <p>"<span><?=(strlen($d->description)<=185)?$d->description:$description?></span>"</p>
              <?php if(($d->author!='' || $d->author_location!='') && !$d->is_private){ ?>
                <?php if($d->author!=''){ ?>
                <p class="banner-author"><cite><?=$d->author?></cite><?php
                  }
                  if($d->author_location!=''){
                ?>
                  <span class="author-location"> - <?=$d->author_location?></span></p>
                <?php } ?>
              <?php } ?>
            </blockquote>
            <div class="fixed-bottom">
              <ul class="share-it">
                <li class="write-review" data-project="<?=$d->id?>"><a href=""><i class="icon-full-conversation"></i><span> Write your review</span></a></li>
                <!-- Commented out for local development -->
                <li class="social-network"><div class="fb-like" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false" data-font="verdana" data-action="like"></div></li>
                <li class="social-network"><a href="https://twitter.com/share" class="twitter-share-button" data-via="streakfreeclean" data-related="streakfreeclean" data-hashtags="WindowCleaning">Tweet</a>
                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></li>
              </ul>
            </div>
            <?php if(count($js_data)>1){ ?>
            <ol class="carousel-indicators">
              <?php
                $ic = 0;
                foreach($js_data as $d){
              ?>
              <li data-target="#<?=$banner_id?>" data-slide-to="<?=$ic?>"<?=($ic==$i)?' class="active"':''?>></li>
              <?php
                  $ic++;
                }
              ?>
            </ol>
            <?php } ?>
          </div>
          <?php if(count($js_data)>1){ ?>
        </div>
        <?php
            }
            $i++;
          }
        ?>
      <?php if(count($js_data)>1){ ?>
      </div>
      <?php } ?>
    </div>
    <div class="curved-shadow">
      <img src="<?php echo THEME_IMAGES; ?>backgrounds/bottom-shadow.png" />
    </div>

    <script type="text/javascript">
      var data_<?=str_replace("-", "_", $banner_id)?> = <?=json_encode($js_data);?>;
      $(document).ready(function(){
        var carousel = $(".carousel-<?=$banner_id?>");
        var current_item_id = 0;
        var current_image_idx = 0;
        var interval = 4000;
        var timeout = setTimeout(function(){
          cycle_image_banner_home_migrate();
        }, interval);
        $(".carousel-indicators li", carousel).mousedown(function(e){
          e.preventDefault();
        }).click(function(){
          clearTimeout(timeout);
          current_item_id = parseInt($(this).attr("data-slide-to"));
          current_image_idx = 0;
          carousel.carousel(current_item_id);
          setTimeout(function(){
            carousel.carousel("pause");
          });
          var items = $(".item", carousel);
          items.removeAttr("style");
          var active_item = items[current_item_id];
          active_image = $(".banner-photo img", active_item);
          if(data_<?=str_replace("-", "_", $banner_id)?>[current_item_id].images)
            active_image.attr("src", data_<?=str_replace("-", "_", $banner_id)?>[current_item_id].images[current_image_idx]);
          active_indicators = $(".carousel-indicators li", active_item);
          $(active_indicators[current_item_id]).addClass("active");
          timeout = setTimeout(function(){
            cycle_image_banner_home_migrate();
          }, interval);
        });
        function cycle_image_banner_home_migrate(){
          clearTimeout(timeout);
          var items = $(".item", carousel);
          var active_item;
          var active_image;
          var banner_photo;
          var new_image;
          var max_width;
          var new_width;
          current_image_idx++;
          if(data_<?=str_replace("-", "_", $banner_id)?>.length>1 && data_<?=str_replace("-", "_", $banner_id)?>[current_item_id].images && current_image_idx>=data_<?=str_replace("-", "_", $banner_id)?>[current_item_id].images.length){
            current_item_id++;
            current_image_idx = 0;
            if(current_item_id>=data_<?=str_replace("-", "_", $banner_id)?>.length){
              current_item_id = 0;
            }
            active_item = items[current_item_id];
            banner_photo = $(".banner-photo", active_item);
            active_image = $("img", banner_photo);
            banner_photo.append("<img src='"+data_<?=str_replace("-", "_", $banner_id)?>[current_item_id].images[current_image_idx]+"' style='position:absolute;left:0;top:0;display:none;' />");
            new_image = $("img", banner_photo).last();
            new_image.load(function(){
              active_image.remove();
              banner_photo.removeAttr("style");
              new_image.removeAttr("style");
              active_image.remove();
              $(active_item).css({"top":0,"position":"absolute","z-index":1});
              $(active_item).fadeIn("fast", function(){
                $(active_item).removeAttr("style");
                carousel.carousel(current_item_id);
                carousel.carousel("pause");
                active_indicators = $(".carousel-indicators li", active_item);
                $(active_indicators[current_item_id]).addClass("active");
                timeout = setTimeout(function(){
                  cycle_image_banner_home_migrate();
                }, interval);
              });
            }).error(function() {
              banner_photo.removeAttr("style");
              new_image.remove();
              timeout = setTimeout(function(){
                cycle_image_banner_home_migrate();
              }, interval);
            });
          }
          else if(data_<?=str_replace("-", "_", $banner_id)?>[current_item_id].images && data_<?=str_replace("-", "_", $banner_id)?>[current_item_id].images.length>1) {
            active_item = items[current_item_id];
            banner_photo = $(".banner-photo", active_item);
            active_image = $("img", banner_photo);
            banner_photo.append("<img src='"+data_<?=str_replace("-", "_", $banner_id)?>[current_item_id].images[current_image_idx]+"' style='position:absolute;left:0;top:0;display:none;' />");
            new_image = $("img", banner_photo).last();
            new_image.load(function(){
              active_image.fadeOut("fast");
              new_image.fadeIn("fast", function(){
                banner_photo.removeAttr("style");
                new_image.removeAttr("style");
                active_image.remove();
                var width = $(".banner-review", active_item).outerWidth();
                timeout = setTimeout(function(){
                  cycle_image_banner_home_migrate();
                }, interval);
                if(data_<?=str_replace("-", "_", $banner_id)?>.length<=1){
                  if(current_image_idx>=data_<?=str_replace("-", "_", $banner_id)?>[current_item_id].images.length-1) current_image_idx = -1;
                }
              });
            }).error(function() {
              banner_photo.removeAttr("style");
              new_image.remove();
              timeout = setTimeout(function(){
                cycle_image_banner_home_migrate();
              }, interval);
            });;
          }
        }
      });
    </script>
    <?php } ?>
  </section>

  <!-- Awards accolades - Done -->
  <?php
  $awards_id = "home_transitional_awards";
  $chosen_carrousel_awards = array();
  if(isset($transitional_accolades['awards']['content'])){
    foreach($transitional_accolades['awards']['content'] as $ac){
      array_push($chosen_carrousel_awards, $ac);
    }
  }
  if(count($chosen_carrousel_awards)>0){
  ?>
  <section class="bg-white bumper-top-small bumper-bottom-small page-left page-right">
    <div id="<?=$awards_id?>" class="carousel-<?=$awards_id?> accolade-carousel slide">
      <?php if(count($chosen_carrousel_awards)>1){ ?>
        <div class="carousel-inner">
      <?php } ?>
        <?php
          $i = 0;
          foreach($chosen_carrousel_awards as $d){
            if(count($chosen_carrousel_awards)>1){
        ?>
        <div class="<?=($i==0)?'active ':''?>item">
          <?php } ?>
          <div class="row-middle center-align bumper-bottom">
          <?php if($d['image']!=''){ ?>
          <div class="middle-fixed-small bumper-right">
            <img src="<?=$d['image']?>" width="150">
          </div>
          <?php } ?>
          <div class="middle">
            <h2><?=$d['title']?></h2>
          </div>
          </div>
        <?php if(count($chosen_carrousel_awards)>1){ ?>
        </div>
        <?php
            }
            $i++;
          }
        ?>
      <?php if(count($chosen_carrousel_awards)>1){ ?>
      </div>
      <?php } ?>
      <?php if(count($chosen_carrousel_awards)>1){ ?>
      <a class="carousel-control left" href="#<?=$awards_id?>" data-slide="prev">&lsaquo;</a>
      <a class="carousel-control right" href="#<?=$awards_id?>" data-slide="next">&rsaquo;</a>
      <?php } ?>
    </div>
    <div class="pen-stroke"></div>
    <script type="text/javascript">
      $(document).ready(function(){
        var carousel = $(".carousel-<?=$awards_id?>");
        carousel.carousel({
          interval: 4000
        });
        carousel.bind("slide", function(){
          $(".item", $(this)).animate({"opacity":0}, 200, function(){
            var items = $(this);
            setTimeout(function(){
              items.animate({"opacity":1}, 200);
            }, 150);
          });
        });
      });
    </script>
  </section>
  <?php } ?>

  <!-- Services list - Done -->
  <section class="bg-slate bumper-top-small bumper-bottom-medium">
    <?php $services = get_terms('services', array('hide_empty' => 0, 'orderby' => 'post_date', 'order' => 'DESC')); ?>
    <div class="bumper-bottom">
      <h2 class="center"><?=parse_shortclass("What we're [green strong]really[/] good at.")?></h2>
    </div>
    <ul class="link-grid clearfix">
      <?php
        if(class_exists('TB_Promote')){
          foreach($services as $service){
            $args = array('post_type' => 'cftl-tax-landing', 'taxonomy' => 'services', 'term' => $service->slug);
            $is_service_promoted = TB_Promote::is_promoted($args);
            $args = array(
              'post_type'   => 'showroom',
              'services'    => $service->slug,
              'order'       => 'ASC',
              'numberposts' => 1
            );
            $service_post_query = new WP_Query( $args );
            $is_have_post = $service_post_query->have_posts();
      ?>
      <li itemprop="makesOffer" itemscope="http://schema.org/Offer">
        <div class="grid-thumb">
          <?php if($is_have_post || $is_service_promoted){ ?>
          <nav>
            <?php if($is_have_post){ ?>
            <a href="<?=get_home_url()."/showroom/".$service->slug?>"><i class="icon-picture icon-white"></i> Showroom</a>
            <?php } if($is_service_promoted){ ?>
            <a href="<?=get_home_url().get_blog_prefix()."services/".$service->slug?>"><i class="icon-info-sign icon-white" itemprop="url"></i> Learn more</a>
            <?php } ?>
          </nav>
          <?php } ?>
          <?php
            $service_image = TOOLBOX_BASE_DIR.'/images/services/'.$service->slug.'.jpg';
            if(file_exists($service_image)){
              $service_image = '<img src="'.TOOLBOX_IMAGES.'/services/'.$service->slug.'.jpg" itemprop="image"/>';
            } else {
              $service_image = '<img src="'.TOOLBOX_IMAGES.'/spacer.gif" style="width:240px;height:75px;background-color:#F6F6F6;" />';
            }
          ?>
          <?=$service_image?>
        </div>
        <?php if($is_service_promoted){ ?>
        <div class="center">
        <a href="<?=get_home_url().get_blog_prefix()."services/".$service->slug?>" itemprop="name"><?=$service->name?></a>
        </div>
        <?php } else { ?>
        <div class="center">
        <span itemprop="name"><?=$service->name?></span>
        </div>
        <?php } ?>
      </li>
      <?php
          }
        }
      ?>
    </ul>
  </section>

  <!-- Headline and featurette - No changes - Done -->
  <section class="bg-white bumper-top-medium bumper-bottom-medium page-left page-right">
    <div class="row-fluid">
      <div class="span5">
        <div>
          <div class="cfct-mod-content"><h2><strong  class="green">Don't take any chances.</strong><br/><br/>We're backed by North America's premier window cleaning network, fully insured and our work is 100% guaranteed.</h2></div>
        </div>
      </div>
      <div class="span7">
        <div class="bumper-bottom">
          <?php
          $award_best = array(
            'img' => TOOLBOX_IMAGES."/accolades/window-cleaning-award.png"
          );
          if(count($transitional_accolades)>0){
            foreach($transitional_accolades['awards']['content'] as $award){
              if($award['term']=='window-cleaning-award'){
                $award_best['img'] = $award['image'];
                break;
              }
            }
          }
          ?>
          <div class="row-middle page-right">
            <div class="middle-fixed-small">
              <img src="<?=$award_best['img']?>" width="130">
            </div>
            <div class="middle">
              <h4>Awarded best in <?=$seo['city']?>, <?=$seo['state']?></h4>
              <p>WindowCleaning.com hand picks our technicians from the best window cleaners in North America. <?=stripslashes($tb_company['name'])?> is the only WindowCleaning.com member in <?=$seo['city']?>, <?=$seo['state']?>.</p>
            </div>
          </div>
        </div>

        <?php
        $streak_free = array(
          'title' => "Hassle free money back guarantee.",
          'img' => TOOLBOX_IMAGES."/accolades/streak-free-guarantee.png",
          'content' => "We’re proud to offer the only $1000 Streak Free Guarantee in ".$seo['city'].", ".$seo['state']." . If you don’t love our work, we’ll refund up to $1000"
        );
        $insured = array(
          'title' => "We carry $1 million in liability insurance.",
          'img' => TOOLBOX_IMAGES."/accolades/insured.png",
          'content' => "Protect your home and family. Only work with fully insured WindowCleaning.com professionals."
        );
        if(count($transitional_accolades)>0){
          foreach($transitional_accolades['guarantees']['content'] as $guarantee){
            if($guarantee['term']=='streak-free-guarantee'){
              $streak_free['title'] = $guarantee['title'];
              $streak_free['img'] = $guarantee['image'];
            }
            if($guarantee['term']=='insured'){
              $insured['title'] = $guarantee['title'];
              $insured['img'] = $guarantee['image'];
              $insured['content'] = $guarantee['description'];
            }
          }
        }
        ?>
        <div>
          <div class="row-middle page-right">
            <div class="middle-fixed-small">
              <img src="<?=$streak_free['img']?>" width="130">
            </div>
            <div class="middle">
              <h4><?=$streak_free['title']?></h4>
              <p><?=$streak_free['content']?></p>
            </div>
          </div>
          <div class="row-middle page-right">
            <div class="middle-fixed-small">
              <img src="<?=$insured['img']?>" width="130">
            </div>
            <div class="middle">
              <h4><?=$insured['title']?></h4>
              <p><?=$insured['content']?></p>
            </div>
          </div>
          <!-- / Accolades -->
        </div>
      </div>
    </div>
  </section>

  <!-- Featured review - Done -->
  <?php
  $reviews_id = "home_transitional_review";
  $args = array(
    'number'  => 1,
    'post_id' => 0,
    'meta_query' => array(
      'relation' => 'AND',
      array(
        'key' => 'featured',
        'value' => '',
        'type' => 'char',
        'compare' => '!='
      )
    )
  );
  $comments = get_comments($args);
  $featured_reviews = array();
  foreach($comments as $comment){
    $listed_comment = new stdClass();
    $listed_comment->id = $comment->comment_ID;
    $listed_comment->name = $comment->comment_author;
    $listed_comment->content = $comment->comment_content;
    $listed_comment->content = str_replace("\n", "<br />", $comment->comment_content);
    $listed_comment->company = get_comment_meta($comment->comment_ID, 'company', true);
    $listed_comment->featured = get_comment_meta($comment->comment_ID, 'featured', true);
    $listed_comment->rating = get_comment_meta($comment->comment_ID, 'rating', true);
    array_push($featured_reviews, $listed_comment);
  }
  if(count($featured_reviews)<=0){
    $args = array(
      'number'  => 1,
      'post_id' => 0,
    );
    $comments = get_comments($args);
    $featured_reviews = array();
    foreach($comments as $comment){
      $listed_comment = new stdClass();
      $listed_comment->id = $comment->comment_ID;
      $listed_comment->name = $comment->comment_author;
      $listed_comment->content = $comment->comment_content;
      $listed_comment->content = str_replace("\n", "<br />", trim($comment->comment_content));
      $listed_comment->company = get_comment_meta($comment->comment_ID, 'company', true);
      $listed_comment->featured = get_comment_meta($comment->comment_ID, 'featured', true);
      $listed_comment->rating = get_comment_meta($comment->comment_ID, 'rating', true);
      array_push($featured_reviews, $listed_comment);
    }
  }
  if(count($featured_reviews)>0){ ?>
  <section class="bg-white bumper-top-small page-left page-right">
    <div>
      <div id="<?=$reviews_id?>" class="review-<?=$reviews_id?> slide" itemscope="http://schema.org/Review" itemprop="review">
        <div class="review review-invert">
          <blockquote class="center well well-has-shadow">
            <?php if(count($featured_reviews)>1){ ?>
            <div class="carousel-inner">
            <?php } ?>
              <?php
                $i = 0;
                foreach($featured_reviews as $r){
                  if(count($featured_reviews)>1){
              ?>
              <div class="<?=($i==0)?'active ':''?>item">
              <?php } ?>
                <p itemprop="comment">"<?=parse_shortclass($r->content)?>"</p>
                <p class="citation">
                  <cite itemprop="author"><?=parse_shortclass($r->name)?></cite>
                  <?php $seo = get_location_seo(); ?>
                  <?php if($r->company!=''){ ?>
                    <span class="author-location"> - <?=parse_shortclass($r->company)?></span>
                  <?php } else if($r->location!=''){ ?>
                    <span class="author-location"> - <?=parse_shortclass($r->location)?></span>
                  <?php } else if(isset($seo['city']) && $seo['city']!='') { ?>
                    <span class="author-location"> - <?=$seo['city'].", ".$seo['state']?> </span>
                  <?php } ?>
                  <a href="<?=home_url()?>/reviews" class="review-link">Read more reviews</a>
                </p>
              <?php if(count($featured_reviews)>1){ ?>
              </div>
              <?php
                  }
                  $i++;
                }
              ?>
            <?php if(count($featured_reviews)>1){ ?>
            </div>
            <?php } ?>
            <?php if(count($featured_reviews)>1){ ?>
            <a class="carousel-control left" href="#<?=$reviews_id?>" data-slide="prev">&lsaquo;</a>
            <a class="carousel-control right" href="#<?=$reviews_id?>" data-slide="next">&rsaquo;</a>
            <?php } ?>
          </blockquote>
          <div class="curved-shadow">
            <img src="<?php echo THEME_IMAGES; ?>backgrounds/bottom-shadow.png" />
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php } ?>

  <!-- Featurette and pinned reviews - Done -->
  <section class="bg-white bumper-top-medium bumper-bottom-medium page-left page-right">
    <div class="row-fluid">
      <div class="span7">
        <div class="has-right-sidebar migrate">
          <div class="cfct-mod-content">
            <h2>Why <?=stripslashes($tb_company['name'])?> was awarded <strong class="green">Best in <?=$seo['city']?>, <?=$seo['state']?>.</strong></h2>
            <?php
              the_post();
              the_content();
            ?>
          </div>
        </div>
      </div>
      <div class="span5">
        <div>
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
    </div>
  </section>

  <!-- Award info - No changes - Done -->
  <section class="bg-white bumper-top-medium bumper-bottom-small page-left page-right">
    <div class="well-blue well well-has-shadow">
      <div class="clearfix">
        <h2 class="white center ">What does the WindowCleaning.com award actually mean?</h2>

        <p class="blueLightest bumper-top">
          WindowCleaning.com is a national network of the <strong>best window cleaners</strong> in each city.
          In most cities, <strong>only one window cleaner is chosen out of hundreds</strong> of window
          cleaners! Each window cleaner is interviewed personally by one of our team. We verify their level of
          experience, if they are properly insured, their reputation in the industry, and how their customers
          feel about the service they provide. Then we choose the best.

          You can be sure, that by choosing a WindowCleaning.com awarded member, you are choosing the best.
          And to back it up, all WindowCleaning.com members offer our no hassle <strong>$1000 Streak Free
          Guarantee!</strong>
        </p>

        <div class="center">
          <div class="btn-group">
            <a href="tel:<?=tb_format_phone_plain(get_phone_number())?>" class="btn btn-primary btn-large hidden-phone" itemprop="telephone"><?=get_phone_number()?></a>
            <button class="btn btn-success btn-large quick-estimate">Quick Online Estimate</button>
          </div>
        </div>
      </div>

    </div>
    <div class="curved-shadow">
      <img src="<?php echo THEME_IMAGES; ?>backgrounds/bottom-shadow.png" />
    </div>
  </section>

  <?
  $transitional_certifications = $transitional_accolades['certifications']['content'];
  if(count($transitional_certifications)>0){
    $id = 'home_transitional_certifications';
  ?>
  <!-- Certifications -->
  <section class="bg-white bumper-top bumper-bottom-small page-left page-right">
  	<div class="center">
  		<h2>We're <strong class="green">proud to be members</strong> of the:</h2>
  	</div>
  	
    <div id="<?=$id?>" class="<?=(count($transitional_certifications)>1)?'carousel-'.$id:''?> accolade-carousel slide">
      <?php if(count($transitional_certifications)>1){ ?>
      <div class="carousel-inner">
      <?php } ?>
        <?php
          $i = 0;
          foreach($transitional_certifications as $d){
            if(count($transitional_certifications)>1){
        ?>
        <div class="<?=($i==0)?'active ':''?>item">
          <?php } ?>
          <div class="row-middle center-align bumper-bottom">
          <?php if($d['image']!=''){ ?>
          <div class="middle-fixed-small bumper-right">
            <img src="<?=$d['image']?>" width="150">
          </div>
          <?php } ?>
          <div class="middle">
            <h2><?=$d['title']?></h2>
          </div>
          </div>
        <?php if(count($transitional_certifications)>1){ ?>
        </div>
        <?php
            }
            $i++;
          }
        ?>
      <?php if(count($transitional_certifications)>1){ ?>
      </div>
      <?php } ?>
      <?php if(count($transitional_certifications)>1){ ?>
      <a class="carousel-control left" href="#<?=$id?>" data-slide="prev">&lsaquo;</a>
      <a class="carousel-control right" href="#<?=$id?>" data-slide="next">&rsaquo;</a>
      <?php } ?>
    </div>
    <div class="pen-stroke"></div>
    <script type="text/javascript">
      <?php $js_id = 'data_'.str_replace('-','_',$id); ?>
      var <?=$js_id?> = <?=json_encode($transitional_certifications)?>;
      $(document).ready(function(){
        var carousel = $(".carousel-<?=$id?>");
        carousel.carousel({
          interval: 4000
        });
        carousel.bind("slide", function(){
          $(".item", $(this)).animate({"opacity":0}, 200, function(){
            var items = $(this);
            setTimeout(function(){
              items.animate({"opacity":1}, 200);
            }, 150);
          });
        });
      });
    </script>
  </section>
  <?php } ?>

  <!-- Address and were we work - Done -->
  <section class="bg-white bumper-top-medium bumper-bottom-medium page-left page-right">
    <div class="row-fluid">
      <div class="span8">
        <!-- Address Module - Company address and Google map ===================================================== -->
        <?php
          $company_name = stripslashes(isset($tb_company['name'])?$tb_company['name']:'');
          $company_street = isset($tb_company['street'])?$tb_company['street']:'';
          $company_city = isset($tb_company['city'])?$tb_company['city']:'';
          $company_state = isset($tb_company['state'])?$tb_company['state']:'';
          $company_zip = isset($tb_company['zip'])?$tb_company['zip']:'';
          $company_phone = get_phone_number();
          $users = get_users();
          $owner_name = '';
          $owner_role = '';
          $owner_email = '';
          if(count($users)>0){
            foreach($users as $user){
              $roles = $user->roles;
              if(count($roles)>0){
                if((in_array('manager', $roles) && $owner_role=='') || in_array('owner', $roles)){
                  $owner_name = $user->first_name.' '.$user->last_name;
                  $owner_role = ucfirst($roles[0]);
                  $owner_email = $user->user_email;
                }
              }
            }
          }
        ?>
        <div class="pull-left bumper-right-medium bumper-bottom">
          <img class="img-polaroid" src="http://maps.google.com/maps/api/staticmap?center=<?=urlencode($company_street).'+'.urlencode($company_city.', '.$company_state).'+'.urlencode($company_zip)?>&amp;zoom=11&amp;size=270x210&amp;maptype=roadmap&amp;markers=color:blue%7Clabel:A%7C<?=urlencode($company_street).'+'.urlencode($company_city.', '.$company_state).'+'.urlencode($company_zip)?>&amp;sensor=false" itemprop="image">
        </div>
        <div>
          <h3 class="light-weight"><?=parse_shortclass("Come say hello...")?></h3>
          <address itemprop="location" itemscope="http://schema.org/PostalAddress">
            <strong><?=$company_name?></strong><br>
            <span itemprop="streetAddress"><?=$company_street?></span><br>
            <span itemprop="addressLocality"><?=$company_city?></span>, <?=$company_state?> <?=$company_zip?><br>
            <abbr title="Phone">P:</abbr> <span itemprop="telephone"><?=$company_phone?></span>
          </address>

          <address itemprop="founder" itemscope="http://schema.org/Person">
            <strong itemprop="name"><?=$owner_name?></strong><span class="grayLight">, <span itemprop="jobTitle"><?=$owner_role?></span></span><br>
            <a href="mailto:<?=$owner_email?>" itemprop="email"><?=$owner_email?></a>
          </address>
        </div>
        <!-- / Address -->
      </div>
      <div class="span4">
        <div>
          <!-- Service area Module - List of locations serviced ===================================================== -->
          <div>
            <h3 class="light-weight"><?=parse_shortclass("Where we work...")?></h3>
            <ul>
              <?php
              $users = get_users();
              $owner_id = '';
              if(count($users)>0){
                foreach($users as $user){
                  $roles = $user->roles;
                  if(count($roles)>0){
                    if($roles[0]=='owner'){
                      $owner_id = $user->id;
                    }
                  }
                }
              }

              $blogs_list = array();
              $locations_list = array();
              $blog_seo_list = array();
              $current_blog_id = get_current_blog_id();

              if($owner_id!='' && $owner_id>0){
                $blogs = get_blogs_of_user($owner_id);
                if(count($blogs)>0){
                  foreach($blogs as $user_blog){
                    array_push($blogs_list, $user_blog->userblog_id);
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
                  $blog_seo_slug = strtolower(preg_replace("/[^A-Za-z0-9\_\-]/", '', $blog_seo['seo_target_city'])).'-'.strtolower($blog_seo['seo_target_state']);
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
                $locations = get_terms('locations', array('hide_empty' => 0));
                if($user_blog!=$current_blog_id) restore_current_blog();

                // Process those locations
                if(count($locations)>0){
                  foreach($locations as $location) {
                    $args = array('post_type' => 'cftl-tax-landing', 'taxonomy' => 'locations', 'term' => $location->slug);
                    $is_location_promoted = TB_Promote::is_promoted($args);
                    $loc_link = '';
                    if($is_location_promoted){
                      $loc_link = home_url().((get_blog_prefix()!='')?get_blog_prefix():'/').'locations/'.($location->slug);
                    }
                    else if(count($blog_seo_list)>0) {
                      $li_found = false;
                      for($li=0;$li<count($blog_seo_list) && !$li_found;$li++){
                        $blog_seo = $blog_seo_list[$li];
                        if($blog_seo->slug==$location->slug){
                          $loc_link = $blog_seo->link;
                          $li_found = true;
                        }
                      }
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
              if(count($blog_seo_list)>0) {
                foreach($blog_seo_list as $blog_seo){
                  $new_blog_location = new stdClass();
                  $new_blog_location->slug = $blog_seo->slug;
                  $new_blog_location->name = $blog_seo->name;
                  $new_blog_location->link = $blog_seo->link;
                  array_push($locations_list, $new_blog_location);
                }
              }
              // Sort it by name
              if(!function_exists('locsort')){
                function locsort($a,$b) {
                  return strcmp($a->name, $b->name)>0;
                }
              }
              uasort($locations_list, "locsort");
              if(count($locations_list)>0){
                foreach($locations_list as $location){
              ?>
              <li><?=(($location->link)?"<a href=\"".$location->link."\">":"").$location->name.(($location->link)?"</a>":"")?></li>
              <?php
                }
              }
              ?>
            </ul>
          </div>
          <!-- / Service area -->
        </div>
      </div>
    </div>
  </section>

</div>
<?php get_footer(); ?>