<?php
/**
 * Description: Banner Module - default view.
 * A module to display a carousel of projects or manually entered image and content.
 *
 * @package
 * @subpackage
 * @since
 */
?>

<div id="<?=$id?>" class="<?=(count($js_data)>1)?'carousel-'.$id.' ':''?>banner">
  <?php if(count($js_data)>1){ ?>
  <ol class="carousel-indicators">
    <?php
      $i = 0;
      foreach($js_data as $d){
    ?>
    <li data-target="#<?=$id?>" data-slide-to="<?=$i?>"<?=($i==0)?' class="active"':''?>></li>
    <?php
        $i++;
      }
    ?>
  </ol>
  <div class="carousel-inner">
  <?php } ?>
    <?php
      $i = 0;
      foreach($js_data as $d){
        if(count($js_data)>0){
    ?>
    <div class="<?=($i==0)?'active ':''?>item">
      <?php } ?>
      <div class="banner-photo">
        <img id="image-<?=$id?>" src="<?=$d->images[0]?>">
      </div>
      <div class="banner-review">
        <blockquote>
          <p>"<span id="title-<?=$id?>"><?=$d->title?></span>"</p>
          <?php if($d->author!='' || $d->author_location!=''){ ?>
            <?php if($d->author!=''){ ?>
            <p class="banner-author"><cite id="author-<?=$id?>"><?=$d->author?></cite><?php
              }
              if($d->author_location!=''){
            ?>,
              <span id="author-location-<?=$id?>"><?=$d->author_location?></span></p>
            <?php } ?>
          <?php } ?>
        </blockquote>
        <div class="fixed-bottom">
          <ul class="share-it">
            <li class="write-review"><a href="" class="write-review"><i class="icon-full-conversation"></i> Write your review</a></li>
            <!-- Commented out for local development -->
            <!--li class="social-network"><div class="fb-like" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false" data-font="verdana" data-action="like"></div></li>
            <li class="social-network"><a href="https://twitter.com/share" class="twitter-share-button" data-via="streakfreeclean" data-related="streakfreeclean" data-hashtags="WindowCleaning">Tweet</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></li-->
          </ul>
        </div>
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
<?=$js_init?>