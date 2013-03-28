<!-- Featurette - Title and text vertical middle aligned with a photo or icon
=============================================================================
-->

<div class="row-middle bumper-top">
	<div class="middle bumper-right-large">
		<h2 class=""><?=$title?></h2>
		<p class="blue"><?=$content?></p>
	</div>
  <?php if($image!=''){ ?>
	<div class="middle6">
    <div class="img-polaroid">
      <div>
        <img src="<?=$image?>">
      </div>
    </div>
	</div>
  <?php } ?>
</div>

<!-- / Featurette -->