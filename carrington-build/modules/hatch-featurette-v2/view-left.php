<!-- Featurette - Horizontal with image left -->

<div class="container full featurette-media">
  <div class="row">
    <div class="col-lg-12">
      <div class="container <?=($image=='' && $video=='')?'full':''?>">
        <div class="row">
          <?php if($image!='' || $video!=''){?>
          <div class="col-xs-12 <?=$photo_classes?> photo <?=($image_size!='auto')?$image_size:''?> left vertical-spacing">
            <?php if($video!=''){?>
              <div class="vertical-middle">
                <?=parse_embed_video_link($video)?>
              </div>
            <?php } else { ?>
              <?php if($image!=''){ ?>
                <div class="vertical-middle <?=$border_style?> animated" data-animation="fadeInRight">
                  <img src="<?=$image?>" />
                </div>
              <?php } ?>
            <?php } ?>
          </div>
          <?php } ?>
          <div class="col-xs-12 <?=($image!='' || $video!='')?$text_classes:''?> text right">
            <p><?=$content?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- / Featurette -->