<!-- Hero Module -  JumboTron style - Giant image with a headline text and citation
===========================================================================================================
-->
<div class="jumbotron">
  <div class="jumbotron-content hidden-phone <?=($border_style=='round')?'round-corner':''?>" style="background: url(<?=$image?>); background-size: cover;">
    <<?=$heading?> class="white jumbo loud page-left page-right bumper-bottom">"<?=parse_embed_video_link(parse_shortclass($title))?>"</<?=$heading?>>
    <<?=$content_style?> class="white light-weight"><?=$content?></<?=$content_style?>>
  </div>
</div>

<!-- / JumboTron -->