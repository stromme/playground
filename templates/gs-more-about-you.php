<?php
$tb_company = get_option('tb_company');
$wpseo_social = get_option('wpseo_social');
?>
<div id="input-container" class="tier question table">
  <div class="vertical-center">
    <div><input type="text" id="input-website" validation="website" placeholder="Your current website" class="input-lg" value="<?=isset($tb_company['website'])?$tb_company['website']:''?>" /></div>
    <div><textarea id="input-reason" validation="not-empty" data-field-name="Reason to choose your company" class="input-lg" placeholder="What is the biggest reason your customers choose your company?"><?=isset($tb_company['description'])?stripslashes($tb_company['description']):''?></textarea></div>
    <div><input type="text" id="input-googleplus" validation="website" placeholder="Company Google+ page" class="input-lg" value="<?=isset($wpseo_social['facebook_site'])?$wpseo_social['facebook_site']:''?>" /></div>
    <div><input type="text" id="input-facebook" validation="website" placeholder="Company Facebook page" class="input-lg" value="<?=isset($wpseo_social['plus-publisher'])?$wpseo_social['plus-publisher']:''?>" /></div>
  </div>
</div>