<!-- Featurette - Title and text vertical middle aligned with a photo or icon
=============================================================================
-->

<div class="row-middle featurette-horizontal">
	<div class="middle <?=($image!='')?$image_padding:''?>">
		<<?=$heading?>><?=$title?></<?=$heading?>>
		<p><?=$content?></p>
	</div>
  <?php if($video!=''){?>
    <div class="<?=$image_size?>">
      <?=parse_embed_video_link($video)?>
    </div>
  <?php } else { ?>
    <?php if($image!=''){ ?>
    <div class="<?=$image_size?>">
       <div<?=($border_style!='none')?' class="'.$border_style.'"':''?>>
         <div>
           <img src="<?=$image?>" />
         </div>
       </div>
    </div>
    <?php } ?>
  <?php } ?>
</div>

<!-- / Featurette -->