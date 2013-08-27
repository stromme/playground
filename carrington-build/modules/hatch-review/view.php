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
  <div id="<?=$id?>" class="<?=(count($reviews)>1)?'carousel-'.$id:''?> review-carousel slide" itemscope="http://schema.org/Review" itemprop="review">
    <div class="review review-invert">
      <blockquote class="center well well-has-shadow">
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
            <p itemprop="comment">"<?=parse_shortclass($r->content)?>"</p>
            <p class="citation">
              <cite itemprop="author"><?=parse_shortclass($r->name)?></cite>
              <?php $seo = get_location_seo(); ?>
              <?php if(isset($r->company) && $r->company!=''){ ?>
                <span class="author-location"> - <?=parse_shortclass($r->company)?></span>
              <?php } else if(isset($r->location) && $r->location!=''){ ?>
                <span class="author-location"> - <?=parse_shortclass($r->location)?></span>
              <?php } else if(isset($seo['city']) && $seo['city']!='') { ?>
                <span class="author-location"> - <?=$seo['city'].", ".$seo['state']?> </span>
              <?php } ?>
              <a href="<?=home_url()?>/reviews" class="review-link">Read more reviews</a>
            </p>
            	
           
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
<?=$js_init?>