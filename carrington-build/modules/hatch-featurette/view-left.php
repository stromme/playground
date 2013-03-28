<!-- Featurette - Title and text vertical middle aligned with a photo or icon
=============================================================================
-->

<div class="row-middle bumper-top">
  <?php if($image!=''){ ?>
	<div class="middle6 bumper-right-large">
    <div class="img-polaroid">
      <div>
        <img src="<?=$image?>">
      </div>
    </div>
	</div>
  <?php } ?>
	<div class="middle">
		<h2 class=""><?=$title?></h2>
		<p class="blue"><?=$content?></p>
	</div>
</div>

<!-- / Featurette -->