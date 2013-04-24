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

$company = get_option('tb_company');
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

?>

<?php /*
<section class="bg-slate page-left page-right bumper-top-medium bumper-bottom-medium top-radius migrate">
	<div class="row-fluid">
		<div class="span8">
			<div class="has-right-sidebar">

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

*/?>

<!-- Wrap the page in .container to centre the content and keep it at a max width -->
<div class="container gentle-shadow">

  <!-- Banner -->
  <section class="bg-white">
    <div id="banner-cfct-module-9b3ef605612ed3f66ea07aa769c74699" class="carousel-banner-cfct-module-9b3ef605612ed3f66ea07aa769c74699 banner" class="top-radius">
      <div class="carousel-inner">
        <div class="active item">
          <div class="banner-photo">
            <img src="http://lars.uzbuz.com/wp-content/uploads/sites/6/2013/04/com-test-oct-cleaner.jpg" />
          </div>
          <div class="banner-review">
            <blockquote>
              <p>"<span id="description-banner-cfct-module-9b3ef605612ed3f66ea07aa769c74699">Couldn't be happier. They showed up on time and did a fantastic job. We'll call again for sure.</span>"</p>
              <p class="banner-author"><cite>Crystal Clear Window Cleaning</cite>
              <span class="author-location"> - Honolulu</span></p>
            </blockquote>
            <div class="fixed-bottom">
              <ul class="share-it">
                <li class="write-review"><a href=""><i class="icon-full-conversation"></i><span> Write your review</span></a></li>
                <!-- Commented out for local development -->
                <li class="social-network"><div class="fb-like" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false" data-font="verdana" data-action="like"></div></li>
                <li class="social-network"><a href="https://twitter.com/share" class="twitter-share-button" data-via="streakfreeclean" data-related="streakfreeclean" data-hashtags="WindowCleaning">Tweet</a>
                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></li>
              </ul>
            </div>
            <ol class="carousel-indicators">
              <li data-target="#banner-cfct-module-9b3ef605612ed3f66ea07aa769c74699" data-slide-to="0" class="active"></li>
              <li data-target="#banner-cfct-module-9b3ef605612ed3f66ea07aa769c74699" data-slide-to="1"></li>
              <li data-target="#banner-cfct-module-9b3ef605612ed3f66ea07aa769c74699" data-slide-to="2"></li>
            </ol>
          </div>
        </div>
        <div class="item">
          <div class="banner-photo">
            <img src="" />
          </div>
          <div class="banner-review">
            <blockquote>
              <p>"<span>Couldn't be happier. They showed up on time and did a fantastic job. We'll call again for sure.</span>"</p>
              <p class="banner-author"><cite>Ernest Nales</cite>
            </blockquote>
            <div class="fixed-bottom">
              <ul class="share-it">
                <li class="write-review"><a href=""><i class="icon-full-conversation"></i><span> Write your review</span></a></li>
                <!-- Commented out for local development -->
                <li class="social-network"><div class="fb-like" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false" data-font="verdana" data-action="like"></div></li>
                <li class="social-network"><a href="https://twitter.com/share" class="twitter-share-button" data-via="streakfreeclean" data-related="streakfreeclean" data-hashtags="WindowCleaning">Tweet</a>
                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></li>
              </ul>
            </div>
            <ol class="carousel-indicators">
              <li data-target="#banner-cfct-module-9b3ef605612ed3f66ea07aa769c74699" data-slide-to="0"></li>
              <li data-target="#banner-cfct-module-9b3ef605612ed3f66ea07aa769c74699" data-slide-to="1" class="active"></li>
              <li data-target="#banner-cfct-module-9b3ef605612ed3f66ea07aa769c74699" data-slide-to="2"></li>
            </ol>
          </div>
        </div>
        <div class="item">
          <div class="banner-photo">
            <img src="http://lars.uzbuz.com/wp-content/uploads/sites/6/2013/04/com-testimonial-credit-union2.jpg" />
          </div>
          <div class="banner-review">
            <blockquote>
              <p>"<span>Couldn't be happier. They showed up on time and did a fantastic job. We'll call again for sure.</span>"</p>
              <p class="banner-author"><cite>Ernest Nales</cite> <span class="author-location"> - Los Angeles</span></p>
            </blockquote>
            <div class="fixed-bottom">
              <ul class="share-it">
                <li class="write-review"><a href=""><i class="icon-full-conversation"></i><span> Write your review</span></a></li>
                <!-- Commented out for local development -->
                <li class="social-network"><div class="fb-like" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false" data-font="verdana" data-action="like"></div></li>
                <li class="social-network"><a href="https://twitter.com/share" class="twitter-share-button" data-via="streakfreeclean" data-related="streakfreeclean" data-hashtags="WindowCleaning">Tweet</a>
                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></li>
              </ul>
            </div>
            <ol class="carousel-indicators">
              <li data-target="#banner-cfct-module-9b3ef605612ed3f66ea07aa769c74699" data-slide-to="0"></li>
              <li data-target="#banner-cfct-module-9b3ef605612ed3f66ea07aa769c74699" data-slide-to="1"></li>
              <li data-target="#banner-cfct-module-9b3ef605612ed3f66ea07aa769c74699" data-slide-to="2" class="active"></li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="curved-shadow">
      <img src="http://lars.uzbuz.com/wp-content/themes/playground/images/backgrounds/bottom-shadow.png" />
    </div>

    <script type="text/javascript">
        var data_banner_cfct_module_9b3ef605612ed3f66ea07aa769c74699 = [
            {"images":["http:\/\/lars.uzbuz.com\/wp-content\/uploads\/sites\/6\/2013\/04\/com-test-oct-cleaner.jpg"], "video":""},
            {"images":[], "video":""},
            {"images":["http:\/\/lars.uzbuz.com\/wp-content\/uploads\/sites\/6\/2013\/04\/com-testimonial-credit-union2.jpg"], "video":""}
        ];
      $(document).ready(function(){
        var carousel = $(".carousel-banner-cfct-module-9b3ef605612ed3f66ea07aa769c74699");
        var current_item_id = 0;
        var current_image_idx = 0;
        var interval = 4000;
        var timeout = setTimeout(function(){
          cycle_image();
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
          active_image.attr("src", data_banner_cfct_module_9b3ef605612ed3f66ea07aa769c74699[current_item_id].images[current_image_idx]);
          active_indicators = $(".carousel-indicators li", active_item);
          $(active_indicators[current_item_id]).addClass("active");
          timeout = setTimeout(function(){
            cycle_image();
          }, interval);
        });
        function cycle_image(){
          clearTimeout(timeout);
          var items = $(".item", carousel);
          var active_item;
          var active_image;
          var banner_photo;
          var new_image;
          var max_width;
          var new_width;
          current_image_idx++;
          if(data_banner_cfct_module_9b3ef605612ed3f66ea07aa769c74699.length>1 && current_image_idx>=data_banner_cfct_module_9b3ef605612ed3f66ea07aa769c74699[current_item_id].images.length){
            current_item_id++;
            current_image_idx = 0;
            if(current_item_id>=data_banner_cfct_module_9b3ef605612ed3f66ea07aa769c74699.length){
              current_item_id = 0;
            }
            active_item = items[current_item_id];
            banner_photo = $(".banner-photo", active_item);
            active_image = $("img", banner_photo);
            banner_photo.append("<img src='"+data_banner_cfct_module_9b3ef605612ed3f66ea07aa769c74699[current_item_id].images[current_image_idx]+"' style='position:absolute;left:0;top:0;display:none;' />");
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
                  cycle_image();
                }, interval);
              });
            }).error(function() {
              banner_photo.removeAttr("style");
              new_image.remove();
              timeout = setTimeout(function(){
                cycle_image();
              }, interval);
            });
          }
          else if(data_banner_cfct_module_9b3ef605612ed3f66ea07aa769c74699[current_item_id].images.length>1) {
            active_item = items[current_item_id];
            banner_photo = $(".banner-photo", active_item);
            active_image = $("img", banner_photo);
            banner_photo.append("<img src='"+data_banner_cfct_module_9b3ef605612ed3f66ea07aa769c74699[current_item_id].images[current_image_idx]+"' style='position:absolute;left:0;top:0;display:none;' />");
            new_image = $("img", banner_photo).last();
            new_image.load(function(){
              active_image.fadeOut("fast");
              new_image.fadeIn("fast", function(){
                banner_photo.removeAttr("style");
                new_image.removeAttr("style");
                active_image.remove();
                var width = $(".banner-review", active_item).outerWidth();
                timeout = setTimeout(function(){
                  cycle_image();
                }, interval);
                if(data_banner_cfct_module_9b3ef605612ed3f66ea07aa769c74699.length<=1){
                  if(current_image_idx>=data_banner_cfct_module_9b3ef605612ed3f66ea07aa769c74699[current_item_id].images.length-1) current_image_idx = -1;
                }
              });
            }).error(function() {
              banner_photo.removeAttr("style");
              new_image.remove();
              timeout = setTimeout(function(){
                cycle_image();
              }, interval);
            });;
          }
        }
      });
    </script>
  </section>

  <!-- Awards accolades - Done -->
  <?php
  $accolades = array(
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
            if(isset($accolades[$term->slug])) $parent_slug = $term->slug;
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
            array_push($accolades[$parent_slug]['content'], array(
              'id' => $ac->ID,
              'title' => $ac->post_title,
              'link' => $ac->post_content,
              'description' => $desc,
              'image' => $accolade_image
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
          array_push($accolades[$terms[0]->slug]['content'], array(
            'id' => $ac->ID,
            'title' => $ac->post_title,
            'link' => $ac->post_content,
            'description' => $desc,
            'image' => $accolade_image
          ));
        }
      }
    }
  }
  $chosen_accolade = array();
  if(isset($accolades['awards']['content'])){
    foreach($accolades['awards']['content'] as $ac){
      array_push($chosen_accolade, $ac);
    }
  }
  if(count($chosen_accolade)>0){
  ?>
  <section class="bg-white bumper-top-small bumper-bottom-small page-left page-right">
    <div id="accolade-cfct-module-migrate-home" class="carousel-accolade-cfct-module-migrate-home accolade-carousel slide">
      <?php if(count($chosen_accolade)>1){ ?>
        <div class="carousel-inner">
      <?php } ?>
        <?php
          $i = 0;
          foreach($chosen_accolade as $d){
            if(count($chosen_accolade)>1){
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
        <?php if(count($chosen_accolade)>1){ ?>
        </div>
        <?php
            }
            $i++;
          }
        ?>
      <?php if(count($chosen_accolade)>1){ ?>
      </div>
      <?php } ?>
      <?php if(count($chosen_accolade)>1){ ?>
      <a class="carousel-control left" href="#<?=$id?>" data-slide="prev">&lsaquo;</a>
      <a class="carousel-control right" href="#<?=$id?>" data-slide="next">&rsaquo;</a>
      <?php } ?>
    </div>
    <div class="pen-stroke"></div>
    <script type="text/javascript">
      $(document).ready(function(){
        var carousel = $(".carousel-accolade-cfct-module-migrate-home");
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
            $args = array('post_type' => 'research', 'taxonomy' => 'services', 'term' => $service->slug);
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
              $service_image = '<img src="'.TOOLBOX_IMAGES.'/spacer.gif" style="width:240px;height:80px;background-color:#F6F6F6;" />';
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
          <div class="row-middle page-right">
            <div class="middle-fixed-small">
              <img src="http://lars.uzbuz.com/wp-content/themes/playground/toolbox-framework/images/accolades/window-cleaning-award.png" width="130">
            </div>
            <div class="middle">
              <h4>North America's Best Window Cleaners</h4>
              <p>We hand pick each WindowCleaning.com technician from the best window cleaners in North America.</p>
            </div>
          </div>
          <!-- / Accolades -->
        </div>
        <div>
          <div class="row-middle page-right">
            <div class="middle-fixed-small">
              <img src="http://lars.uzbuz.com/wp-content/themes/playground/toolbox-framework/images/accolades/streak-free-guarantee.png" width="130">
            </div>
            <div class="middle">
              <h4>Hassle free money back guarantee.</h4>
              <p>We’re proud to offer the only $1000 Streak Free Guarantee in . If you don’t love our work, we’ll refund up to $1000</p>
            </div>
          </div>
          <div class="row-middle page-right">
            <div class="middle-fixed-small">
              <img src="http://lars.uzbuz.com/wp-content/themes/playground/toolbox-framework/images/accolades/insured.png" width="130">
            </div>
            <div class="middle">
              <h4>We carry $1 million in liability insurance.</h4>
              <p>Protect your home and family. Only work with fully insured WindowCleaning.com professionals.</p>
            </div>
          </div>
          <!-- / Accolades -->
        </div>
      </div>
    </div>
  </section>

  <!-- Featured review -->
  <section class="bg-white bumper-top-small page-left page-right">
    <div>
      <div id="review-cfct-module-ef98435c77ff230a91465476732d61e5" class=" review-carousel slide" itemscope="http://schema.org/Review" itemprop="review">
        <div class="review review-invert">
          <blockquote class="center well well-has-shadow">
            <p itemprop="comment">"Larry and Eddie did an awesome job on the windows! They are very professional and courteous. I'm glad I chose Gleam Team! Will definitely recommend them to others."</p>
            <p class="citation">
              <cite itemprop="author">Ruth Jacobsen</cite>
              <span class="author-location"> - Broken Arrow, OK </span>
              <a href="http://lars.uzbuz.com/reviews" class="review-link">Read more reviews</a>
            </p>
          </blockquote>
          <div class="curved-shadow">
            <img src="http://lars.uzbuz.com/wp-content/themes/playground/images/backgrounds/bottom-shadow.png" />
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Featurette and pinned reviews - Done -->
  <section class="bg-white bumper-top-medium bumper-bottom-medium page-left page-right migrate">
    <div class="row-fluid">
      <div class="span7">
        <div>
          <div class="cfct-mod-content">
            <h2>Why <?=$company['name']?> was awarded Best in <?=$seo['city']?>, <?=$seo['state']?>.</h2>
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
            <a href="tel:(123) 123-1233" class="btn btn-primary btn-large hidden-phone">Call us (123) 123-1233</a>
            <button class="btn btn-success btn-large quick-estimate">Quick Online Estimate</button>
          </div>
        </div>
      </div>

    </div>
    <div class="curved-shadow">
      <img src="http://lars.uzbuz.com/wp-content/themes/playground/images/backgrounds/bottom-shadow.png"/>
    </div>
  </section>

  <!-- Address and were we work - Done -->
  <section class="bg-white bumper-top-medium bumper-bottom-medium page-left page-right">
    <div class="row-fluid">
      <div class="span8">
        <!-- Address Module - Company address and Google map ===================================================== -->
        <?php
          $company = get_option('tb_company');
          $company_name = isset($company['name'])?$company['name']:'';
          $company_street = isset($company['street'])?$company['street']:'';
          $company_city = isset($company['city'])?$company['city']:'';
          $company_state = isset($company['state'])?$company['state']:'';
          $company_zip = isset($company['zip'])?$company['zip']:'';
          $company_phone = get_phone_number();
          $users = get_users();
          $owner_name = '';
          $owner_role = '';
          $owner_email = '';
          if(count($users)>0){
            foreach($users as $user){
              $roles = $user->roles;
              if(count($roles)>0){
                if(($roles[0]=='manager' && $owner_role=='') || $roles[0]=='owner'){
                  $owner_name = ucfirst($user->display_name);
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
          <?php
            $company = get_option('tb_company');
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
                  if($user_blog->userblog_id!=get_current_blog_id()){
                    switch_to_blog($user_blog->userblog_id);
                    $blog_seo = get_option('tb_seo');
                    if(isset($blog_seo)){
                      if(isset($blog_seo['seo_target_city']) && isset($blog_seo['seo_target_state'])){
                        $blog_seo_slug = strtolower(preg_replace("/[^A-Za-z0-9\_\-]/", '', $blog_seo['seo_target_city'])).'-'.strtolower($blog_seo['seo_target_state']);
                        $args = array('post_type' => 'research', 'taxonomy' => 'locations', 'term' => $blog_seo_slug);
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
                restore_current_blog();
              }
            }
          ?>
          <div>
            <h3 class="light-weight"><?=parse_shortclass("Where we work")?></h3>
            <ul>
              <?php
                $locations = get_terms('locations', array('hide_empty' => 0));
                $seo_location_exists = array();
                if(count($locations)>0){
                  foreach ($locations as $location) {
                    $name = $location->name;
                    $args = array('post_type' => 'research', 'taxonomy' => 'locations', 'term' => $location->slug);
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
        </div>
      </div>
    </div>
  </section>

</div>
<?php get_footer(); ?>