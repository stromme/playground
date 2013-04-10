<!-- Featurette - Title and text vertical middle aligned with a photo or icon
=============================================================================
-->

<div class="row-middle">
  <?php if($image!=''){ ?>
	<div class="<?=$image_size?> <?=$image_padding?>">
    <div<?=($border_style!='none')?' class="'.$border_style.'"':''?>>
      <div>
        <img src="<?=$image?>" />
      </div>
    </div>
	</div>
  <?php } ?>
	<div class="middle">
		<<?=$heading?>><?=$title?></<?=$heading?>>
		<p><?=$content?></p>
	</div>
</div>

<!-- / Featurette -->