<!-- Featurette - Title and text vertical middle aligned with a photo or icon
=============================================================================
-->

<div class="row-middle featurette-horizontal">
  <?php if($video!='' || $image!=''){ ?><div class="<?=$image_size?> <?=$image_padding?>"><?php } ?>
  <?php if($video!=''){ ?>
    <?=parse_embed_video_link($video)?>
  <?php } else if($image!=''){ ?>
    <div<?=($border_style!='none')?' class="'.$border_style.'"':''?>>
      <div>
        <img src="<?=$image?>" />
      </div>
    </div>
  <?php } ?>
  <?php if($video!='' || $image!=''){ ?></div><?php } ?>
	<div class="middle">
		<<?=$heading?>><?=$title?></<?=$heading?>>
		<p><?=$content?></p>
	</div>
</div>

<!-- / Featurette -->