<!-- Hero Module -  JumboTron style - Giant image with a headline text and citation
===========================================================================================================
-->

<div class="jumbotron hidden-phone <?=($border_style=='round')?'round-corner':''?>" style="background: url('<?php echo THEME_IMAGES; ?>temp/ChicagoSkyline.jpg'); background-size: cover;">
	<<?=$heading?> class="white jumbo loud page-left page-right bumper-bottom">"<?=parse_shortclass($title)?>"</<?=$heading?>>
	<<?=$content_style?> class="white light-weight"><?=parse_shortclass($content)?></<?=$content_style?>>
</div>

<!-- / JumboTron -->