<?php global $prj ?>
<div class="project">
  <div>
    <div class="favorite-photo">
      <img src="" data-src="<?=$prj->favorite_media->image[0]?>" />
      <div>
        <a href="#" ><i class="icon-facebook-2x"></i></a>
        <a href="#"><i class="icon-twitter-2x"></i></a>
      </div>
      <a href="<?=$prj->favorite_media->image_large[0]?>" class="show-image colorbox-element" rel="gallery-<?=$prj->id?>"><i class="icon-fullscreen-2x"></i></a>
      <?php if($prj->media!='' && count($prj->media)>1){ ?>
        <div class="colorbox-image-list" style="display:none;">
          <?php foreach($prj->media as $media){ ?>
            <a href="<?=$media->image_large[0]?>" class="colorbox-element" <?=($prj->favorite_media->image[0]!=$media->image[0])?'rel="gallery-'.($prj->id).'"':''?>></a>
          <?php } ?>
        </div>
      <?php } ?>
    </div>
    <ul class="thumbnails">
      <li>
        <a href="" class="thumbnail" data-image="<?=$prj->favorite_media->image[0]?>">
          <img src="" data-src="<?=$prj->favorite_media->thumbnail?>" />
        </a>
      </li>
      <?php
        if($prj->media!='' && count($prj->media)>1){
          foreach($prj->media as $media){
            if($media->id!=$prj->favorite_media->id){ ?>
              <li>
                <a href="" class="thumbnail" data-image="<?=$media->image[0]?>" data-image-large="<?=$media->image_large[0]?>">
                  <img src="" data-src="<?=$media->thumbnail?>" />
                </a>
              </li>
            <?php
            }
          }
        }
      ?>
    </ul>
    <?php if($prj->content!=''){ ?>
    <blockquote>
      <p>
        <?php if(strlen($prj->content)<110){ ?>
          <?=$prj->content?>
        <?php } else { ?>
          <span class="content-preview"><?=substr($prj->content, 0, 110).'...'?></span>
          <span class="content-full"><?=$prj->content?></span>
          <a href="" class="show-more"><i class="icon-expand-halfling"></i><span>More</span></a>
        <?php } ?>
      </p>
    </blockquote>
    <?php } ?>
    <div class="tags">
      <?php if($prj->contact!=''){ ?>
      <p><i class="icon-map-marker"></i>
        <?php
          if($prj->contact->company!=''){ echo $prj->contact->company; }
          else if($prj->contact->first_name!=''){
            echo $prj->contact->first_name.' ';
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
      <p><a href="<?=$prj->term->slug?>"><i class="icon-tag"></i> <?=$prj->term->name?></a></p>
      <?php } ?>
    </div>
  </div>
  <div class="curved-shadow">
    <img src="<?php echo THEME_IMAGES; ?>backgrounds/bottom-shadow.png" />
  </div>
</div>