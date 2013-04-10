<div class="center">
  <?php if($image!=''){ ?>
  <div class="<?=($border_style!='none')?$border_style:''?> <?=$image_size?>">
    <div>
      <img src="<?=$image?>" />
    </div>
  </div>
  <?php } ?>
  <<?=$heading?>><?=$title?></<?=$heading?>>
  <p><?=$content?></p>
</div>