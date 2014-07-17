<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <div class="text-center vertical-spacing">
        <?php if($image!='' || $video!=''){?>
        <div class="vertical-media <?=($image_size!='auto')?$image_size:''?>">
          <div class="<?=$border_style?> animated" data-animation="fadeInUp">
            <?php if($image!=''){ ?>
            <img src="<?=$image?>" />
            <?php } else if($video!=''){?>
            <?=parse_embed_video_link($video)?>
            <?php } ?>
          </div>
        </div>
        <?php } ?>
        <?php if($content!=''){ ?><p><?=$content?></p><?php } ?>
      </div>
    </div>
  </div>
</div>