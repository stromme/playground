<?php
/**
 * Description: Review Module.
 * A module to display review or reviews.
 *
 * @package
 * @subpackage
 * @since
 */
?>
  <div id="<?=$id?>" class="<?=(count($reviews)>1)?'carousel-'.$id:''?> review-carousel slide">
    <div class="review review-invert bumper-top-large bumper-bottom-large ">
      <blockquote class="center well well-blue well-has-shadow">
        <?php if(count($reviews)>1){ ?>
        <div class="carousel-inner">
        <?php } ?>
          <?php
            $i = 0;
            foreach($reviews as $r){
              if(count($reviews)>1){
          ?>
          <div class="<?=($i==0)?'active ':''?>item">
          <?php } ?>

              <p>"<?=$r->content?>"
              </p>
              <p class="citation"><cite><?=$r->name?></cite>
                <?php if($type=='manual'){ ?>
                  <span class="author-location">~ <?=$r->location?></span>
                <?php } else if($r->company!=''){ ?>
                  <span class="author-location">~ <?=$r->company?></span>
                <?php } ?>
              </p>
              <a href="<?=home_url().get_blog_prefix()?>reviews" class="review-link">Read more reviews</a>

          <?php if(count($reviews)>1){ ?>
          </div>
          <?php
              }
              $i++;
            }
          ?>
        <?php if(count($reviews)>1){ ?>
        </div>
        <?php } ?>
        <?php if(count($reviews)>1){ ?>
        <a class="carousel-control left" href="#<?=$id?>" data-slide="prev">&lsaquo;</a>
        <a class="carousel-control right" href="#<?=$id?>" data-slide="next">&rsaquo;</a>
        <?php } ?>
      </blockquote>
      <div class="curved-shadow">
        <img src="<?php echo THEME_IMAGES; ?>backgrounds/bottom-shadow.png" />
      </div>
    </div>
  </div>

<div class="pen-stroke"></div>
<?=$js_init?>