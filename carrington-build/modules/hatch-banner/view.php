<?php
/**
 * Description: Banner Module - default view.
 * A module to display a carousel of projects or manually entered image and content.
 *
 * @package
 * @subpackage
 * @since
 */;
?>
<?php if(count($banner_data)>0){ ?>
  <div id="<?=$id?>" class="<?=(count($banner_data)>1)?'carousel-'.$id.' ':''?>banner" class="top-radius">
    <?php if(count($banner_data)>1){ ?>
    <div class="carousel-inner">
    <?php } ?>
      <?php
        $i = 0;
        foreach($banner_data as $d){
          //var_dump($d);
          //exit;
          if(count($banner_data)>1){
      ?>
      <div class="<?=($i==0)?'active ':''?>item">
        <?php } ?>
        <div class="banner-photo">
          <?php if($d->video!=''){?>
            <?=parse_embed_video_link($d->video)?>
          <?php } else { ?>
            <img id="<?=$d->images[0]['id']?>" src="<?=$d->images[0]['src']?>" itemprop="image" />
          <?php } ?>
        </div>
        <div class="banner-review">
          <blockquote>
            <?php $description = substr($d->description, 0, 180)."..."; ?>
            <!-- <?php var_dump($d->description); ?> -->
            <?php if($d->description!=""){ ?>
            <p>"<span<?=(strlen($description)>160)?" class=\"smaller\"":""?>><?=(strlen($d->description)<=185)?$d->description:$description?></span>"</p>
            <?php } ?>
            <?php if(($d->author!='' || $d->company!='' || $d->author_location!='') && !$d->is_private){ ?>
              <p class="banner-author">
              <?php if($d->author!='' && $d->company!=''){ ?>
                <cite<?=(strlen($d->author)>16)?" class=\"smaller\"":""?>><?=$d->author?></cite><span class="author-location<?=(strlen($d->company)>25)?" smaller":""?>"> - <?=$d->company?></span>
              <?php } else { ?>
                <?php if($d->author!=''){ ?>
                <cite<?=(strlen($d->author)>16)?" class=\"smaller\"":""?>><?=$d->author?></cite>
                <?php } else if($d->company!='') { ?>
                <cite<?=(strlen($d->company)>16)?" class=\"smaller\"":""?>><?=$d->company?></cite>
                <?php } ?>
                <?php if($d->author_location!=''){ ?>
                <span class="author-location<?=(strlen($d->author_location)>25)?" smaller":""?>"> - <?=$d->author_location?></span>
                <?php } ?>
              <?php } ?>
              </p>
            <?php } ?>
          </blockquote>
          <div class="fixed-bottom">
            <ul class="share-it">
              <li class="write-review" data-project="<?=$d->id?>"><a href=""><i class="icon-full-conversation"></i><span> Write your review</span></a></li>
              <!-- Commented out for local development -->
              <li class="social-network sc-facebook"><div class="fb-like" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false" data-font="verdana" data-action="like"></div></li>
              <?php $tw = get_site_option('tb_twitter_share'); ?>
              <li class="social-network sc-twitter"><a href="https://twitter.com/share" class="twitter-share-button" <?=(isset($tw['account'])?'data-via="'.$tw['account'].'" data-related="'.$tw['account'].'"':'')?> <?=(isset($tw['hashtags'])?'data-hashtags="'.$tw['hashtags'].'"':'')?>>Tweet</a>
              <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></li>
            </ul>
          </div>
          <?php if(count($banner_data)>1){ ?>
          <ol class="carousel-indicators">
            <?php
              $ic = 0;
              foreach($banner_data as $d){
            ?>
            <li data-target="#<?=$id?>" data-slide-to="<?=$ic?>"<?=($ic==$i)?' class="active"':''?>></li>
            <?php
                $ic++;
              }
            ?>
          </ol>
          <?php } ?>
        </div>
        <?php if(count($banner_data)>1){ ?>
      </div>
      <?php
          }
          $i++;
        }
      ?>
    <?php if(count($banner_data)>1){ ?>
    </div>
    <?php } ?>
  </div>
<?php } ?>
<div class="curved-shadow">
	<img src="<?php echo THEME_IMAGES; ?>backgrounds/bottom-shadow.png" />
</div>
<?php if(count($banner_data)>0){ ?><?=$js_init?><?php } ?>
<?php if(isset($_GET['reviewme'])){ ?>
<script type="text/javascript">
$(document).ready(function(){
  if($('#new-review').is(':hidden') && $('.write-review').length>0) $('.write-review').click();
});
</script>
<?php } ?>