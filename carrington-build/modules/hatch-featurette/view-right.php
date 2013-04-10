<!-- Featurette - Title and text vertical middle aligned with a photo or icon
=============================================================================
-->

<div class="row-middle">
	<div class="middle <?=($image!='')?$image_padding:''?>">
		<<?=$heading?>><?=$title?></<?=$heading?>>
		<p><?=$content?></p>
	</div>
  <?php if($image!=''){ ?>
  <div class="<?=$image_size?>">
     <div<?=($border_style!='none')?' class="'.$border_style.'"':''?>>
       <div>
         <img src="<?=$image?>" />
       </div>
     </div>
  </div>
  <?php } ?>
</div>

<!-- / Featurette -->