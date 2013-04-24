<!-- Address Module - Company address and Google map
=====================================================
-->

<?php
$company_name = isset($company['name'])?$company['name']:'';
$company_street = isset($company['street'])?$company['street']:'';
$company_city = isset($company['city'])?$company['city']:'';
$company_state = isset($company['state'])?$company['state']:'';
$company_zip = isset($company['zip'])?$company['zip']:'';
$company_phone = get_phone_number();
$users = get_users();
$owner_name = '';
$owner_role = '';
$owner_email = '';
if(count($users)>0){
  foreach($users as $user){
    $roles = $user->roles;
    if(count($roles)>0){
      if((in_array('manager', $roles) && $owner_role=='') || in_array('owner', $roles)){
        $owner_name = ucfirst($user->display_name);
        $owner_role = ucfirst($roles[0]);
        $owner_email = $user->user_email;
      }
    }
  }
}
?>

<div class="pull-left bumper-right-medium bumper-bottom">
	<img class="img-polaroid" src="http://maps.google.com/maps/api/staticmap?center=<?=urlencode($company_street).'+'.urlencode($company_city.', '.$company_state).'+'.urlencode($company_zip)?>&amp;zoom=11&amp;size=270x210&amp;maptype=roadmap&amp;markers=color:blue%7Clabel:A%7C<?=urlencode($company_street).'+'.urlencode($company_city.', '.$company_state).'+'.urlencode($company_zip)?>&amp;sensor=false" itemprop="image">
</div>
<div class="">
	<h3 class="light-weight"><?=parse_shortclass($title)?></h3>
	<address itemprop="location" itemscope="http://schema.org/PostalAddress">
	  <strong><?=$company_name?></strong><br>
    <span itemprop="streetAddress"><?=$company_street?></span><br>
    <span itemprop="addressLocality"><?=$company_city?></span>, <?=$company_state?> <?=$company_zip?><br>
	  <abbr title="Phone">P:</abbr> <span itemprop="telephone"><?=$company_phone?></span>
	</address>

	<address itemprop="founder" itemscope="http://schema.org/Person">
	  <strong itemprop="name"><?=$owner_name?></strong><span class="grayLight">, <span itemprop="jobTitle"><?=$owner_role?></span></span><br>
	  <a href="mailto:<?=$owner_email?>" itemprop="email"><?=$owner_email?></a>
	</address>
</div>

<!-- / Address -->