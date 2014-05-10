<?php
/**
 * Description: Accolade Module - featurette style.
 * A module to display accolade.
 *
 * @package
 * @subpackage
 * @since
 */
?>

<?php
  if(isset($chosen_accolade) && count($chosen_accolade)>0){
    foreach($chosen_accolade as $accolade){
?>
<div class="row-middle page-right">
	<div class="middle-fixed-small">
		<img src="<?=$accolade['image']?>" width="130">
	</div>
	<div class="middle">
		<h4><?=$accolade['title']?></h4>
		<p><?=$accolade['description']?></p>
	</div>
</div>
<?php
    }
  }
?>
<!-- / Accolades -->