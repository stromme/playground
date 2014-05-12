<?php
$owner = get_site_owner();
$cell_phone = isset($owner->cell_phone)?tb_format_us_phone_number($owner->cell_phone, false):'';
?>
<div class="tier even question">
  What cell number would you like your instant SMS lead notifications sent to?
</div>
<div id="input-container" class="tier table">
  <div class="vertical-center">
    <div><input type="text" id="input-cell-phone" validation="not-empty phone" placeholder="Cell Phone" class="input-lg" value="<?=$cell_phone?>" /></div>
  </div>
</div>