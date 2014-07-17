<!-- Featurette - Horizontal with image right -->

<div class="container full featurette-media">
  <div class="row">
    <div class="col-lg-12">
      <div class="container <?=($image=='' && $video=='')?'full':''?>">
        <div class="row">
          <?php if($video!='' || $image!='') { ?>
          <div class="col-xs-12 <?=$photo_classes?> <?=$photo_push_classes?> photo <?=($image_size!='auto')?$image_size:''?> right vertical-spacing">
            <?php if($video!=''){?>
              <div class="vertical-middle">
                <?=parse_embed_video_link($video)?>
              </div>
            <?php } else { ?>
              <?php if($image!=''){ ?>
                <div class="vertical-middle <?=$border_style?> animated" data-animation="fadeInLeft">
                  <img src="<?=$image?>" />
                </div>
              <?php } ?>
            <?php } ?>
          </div>
          <?php } else {
            $text_classes = $text_pull_classes = '';
          } ?>
          <div class="col-xs-12 <?=($image!='' || $video!='')? $text_classes.' '.$text_pull_classes : ''?> <?=(strstr($image_size, 'fixed-'))?$image_size.'-responsive':''?> text left">
            <p><?=$content?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- / Featurette -->