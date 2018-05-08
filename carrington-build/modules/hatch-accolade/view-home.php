<?php
/**
 * Description: Accolade Module - home style.
 * A module to display accolade.
 *
 * @package
 * @subpackage
 * @since
 */

$seo = get_location_seo();
?>
<div class="bumper-bottom">
  <?php
  if(!$tb_company) $tb_company = get_option('tb_company');
  $award_best = array(
    'img' => TOOLBOX_IMAGES."/accolades/window-cleaning-award.png"
  );
  if(count($chosen_accolade)>0){
    foreach($chosen_accolade['awards']['content'] as $award){
      if($award['term']=='window-cleaning-award'){
        $award_best['img'] = $award['image'];
        break;
      }
    }
  }
  ?>
  <div class="row-middle">
    <div class="middle-fixed-small">
      <img src="<?=$award_best['img']?>" width="130">
    </div>
    <div class="middle">
      <h4>Awarded best in <?=$seo['city']?></h4>
      <p>WindowCleaning.com hand picks our technicians from the best window cleaners in North America. <?=stripslashes($tb_company['name'])?> is the only WindowCleaning.com member in <?=$seo['city']?>, <?=$seo['state']?>.</p>
    </div>
  </div>
</div>

<?php
$streak_free = array(
  'title' => "Hassle free money back guarantee.",
  'img' => TOOLBOX_IMAGES."/accolades/streak-free-guarantee.png",
  'content' => "We’re proud to offer the only $1000 Streak Free Guarantee in ".$seo['city'].", ".$seo['state'].". If you don’t love our work, we’ll refund up to $1000"
);
$insured = array(
  'title' => "We carry $1 million in liability insurance.",
  'img' => TOOLBOX_IMAGES."/accolades/insured.png",
  'content' => "Protect your home and family. Only work with fully insured WindowCleaning.com professionals."
);
if(count($chosen_accolade)>0){
  foreach($chosen_accolade['guarantees']['content'] as $guarantee){
    if($guarantee['term']=='streak-free-guarantee'){
      $streak_free['title'] = $guarantee['title'];
      $streak_free['img'] = $guarantee['image'];
    }
    if($guarantee['term']=='insured'){
      $insured['title'] = $guarantee['title'];
      $insured['img'] = $guarantee['image'];
      $insured['content'] = $guarantee['description'];
    }
  }
}
?>
<div>
  <div class="row-middle">
    <div class="middle-fixed-small">
      <img src="<?=$streak_free['img']?>" width="130">
    </div>
    <div class="middle">
      <h4><?=$streak_free['title']?></h4>
      <p><?=$streak_free['content']?></p>
    </div>
  </div>
  <div class="row-middle">
    <div class="middle-fixed-small">
      <img src="<?=$insured['img']?>" width="130">
    </div>
    <div class="middle">
      <h4><?=$insured['title']?></h4>
      <p><?=$insured['content']?></p>
    </div>
  </div>
  <!-- / Accolades -->
</div>