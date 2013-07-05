<?php global $prj ?>
<div class="project" itemprop="review" itemscope="http://schema.org/Review">
  <div class="project-container">
    <?php if(count($prj->media)>0){ ?>
      <div class="favorite-photo">
        <img src="<?=TOOLBOX_IMAGES.'/spacer.gif'?>" data-src="<?=$prj->favorite_media->image[0]?>" itemprop="image" />
        <div class="media-controls <?=($prj->favorite_media->media_type=="video")?"show-video-play":""?>">
          <a href="<?=$prj->favorite_media->image_large[0]?>" class="show-image colorbox-element" <?=($prj->favorite_media->media_type=="video")?"data-video=\"1\"":""?> rel="gallery-<?=$prj->id?>"><i class="<?=($prj->favorite_media->media_type=="video")?"icon-media-play":"icon-media-expand"?>"></i></a>
        </div>
        <div class="media-controls">
          <a onclick="share_project('twitter', '<?=home_url().'/projects/'.$prj->slug?>', '<?=$prj->title?>');" href="javascript:void(0);" ><i class="icon-media-twitter"></i></a>
          <a onclick="share_project('facebook', '<?=home_url().'/projects/'.$prj->slug?>', '<?=$prj->title?>');" href="javascript:void(0);"><i class="icon-media-facebook"></i></a>
        </div>
        <?php if($prj->media!='' && count($prj->media)>1){ ?>
          <div class="colorbox-image-list">
            <?php foreach($prj->media as $media){ ?>
              <a href="<?=$media->image_large[0]?>" class="colorbox-element" <?=($media->media_type=="video")?"data-video=\"1\"":""?> <?=($prj->favorite_media->image[0]!=$media->image[0])?'rel="gallery-'.($prj->id).'"':''?>></a>
            <?php } ?>
          </div>
        <?php } ?>
      </div>
      <?php if($prj->media!='' && count($prj->media)>1){ ?>
      <ul class="thumbnails">
        <li>
          <a href="" class="thumbnail" <?=($prj->favorite_media->media_type=="video")?"data-video=\"1\"":""?> data-image="<?=$prj->favorite_media->image[0]?>" data-image-large="<?=$prj->favorite_media->image_large[0]?>">
            <img src="<?=TOOLBOX_IMAGES.'/spacer.gif'?>" data-src="<?=$prj->favorite_media->thumbnail?>" />
          </a>
        </li>
        <?php
          foreach($prj->media as $media){
            if($media->id!=$prj->favorite_media->id){ ?>
              <li>
                <a href="" class="thumbnail" <?=($media->media_type=="video")?"data-video=\"1\"":""?> data-image="<?=$media->image[0]?>" data-image-large="<?=$media->image_large[0]?>">
                  <img src="<?=TOOLBOX_IMAGES.'/spacer.gif'?>" data-src="<?=$media->thumbnail?>" />
                </a>
              </li>
            <?php
            }
          }
        ?>
      </ul>
      <?php } ?>
    <?php } ?>
    <?php if(isset($prj->reviews) && count($prj->reviews)>0){ ?>
    <div class="customer-review">
      <h3>Customer reviewed</h3>
      <?php foreach($prj->reviews as $review){ ?>
      <p>"<?=$review->content?>"
      </p>
      <div class="author">
        <p><cite><?=$review->name?></cite> &nbsp;<span class="review-rating" data-score="<?=$review->rating?>"></span></p>
      </div>
      <?php } ?>
    </div>
    <?php } ?>
    <?php if($prj->content!=''){ ?>
    <blockquote>
      <p>
        <?php if(strlen($prj->content)<405){ ?>
          <span class="content-description" itemprop="description"><?=$prj->content?></span>
        <?php } else { ?>
          <span class="content-description" itemprop="description">
            <?=substr($prj->content, 0, 400).'...'?>
            <a href="" class="show-more"><i class="icon-collapse-halfling"></i></a>
          </span>
          <span class="content-preview"></span>
          <span class="content-rest"><?=substr($prj->content, 400)?></span>
        <?php } ?>
      </p>
    </blockquote>
    <?php } ?>
    <div class="tags">
      <?php if($prj->contact!='' && !$prj->contact->is_private){ ?>
      <p><i class="showroom-icon-map-marker"></i>
        <?php
          if($prj->contact->company!=''){ echo $prj->contact->company; }
          else if($prj->contact->first_name!=''){
            echo '<itemprop="author">'.$prj->contact->first_name.'</itemprop> ';
            if($prj->contact->last_name!=''){
              echo $prj->contact->last_name;
            }
          }
          if($prj->contact->city!=''){
        ?>
        <small>- <?=$prj->contact->city?></small>
        <?php } ?>
      </p>
      <?php } ?>
      <?php if($prj->term!=''){ ?>
      <p itemprop="itemReviewed"><a href="<?=home_url().'/showroom/'.$prj->term->slug?>"><i class="showroom-icon-tag"></i> <?=$prj->term->name?></a></p>
      <?php } ?>
    </div>
  </div>
  <div class="curved-shadow">
    <img src="<?php echo THEME_IMAGES; ?>backgrounds/bottom-shadow.png" />
  </div>
</div>