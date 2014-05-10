<div class="center featurette-vertical">
  <?php if($video!=''){?>
    <?=parse_embed_video_link($video)?>
  <?php } else { ?>
    <?php if($image!=''){ ?>
    <div class="<?=($border_style!='none')?$border_style:''?> <?=$image_size?>">
      <div>
        <img src="<?=$image?>" />
      </div>
    </div>
    <?php } ?>
  <?php } ?>
  <<?=$heading?>><?=$title?></<?=$heading?>>
  <p><?=$content?></p>
</div>