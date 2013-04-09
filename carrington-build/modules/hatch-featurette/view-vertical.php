<div class="center">
  <?php if($image!=''){ ?>
  <div class="<?=($border_style!='none')?$border_style:''?> <?=$image_size?>">
    <div>
      <img src="<?=$image?>" />
    </div>
  </div>
  <?php } ?>
  <<?=$heading?>><?=parse_shortclass($title)?></<?=$heading?>>
  <p><?=parse_shortclass($content)?></p>
</div>