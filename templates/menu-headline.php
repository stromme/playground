<?php
/**
 * Template_Name: Headline
 * Description: Fixed to top page headline and call to action
 *
 * @package 
 * @subpackage 
 * @since 
 */

$seo = get_location_seo();
?>

<!-- Headline - Fixed to top of page
==================================================
-->
<section class="fixed-top">
	<div class="container headline">
		<ul>
			<li class="headline-title green-man-45">
				<h1>Awarded <?=date('Y')?> <b>Best Window Cleaners</b> in <a href="<?=get_home_url().get_blog_prefix()."/locations/"?>" class="link-inverse link-decorate link-showoff" data-toggle="tooltip" data-placement="bottom" title="Visit another location"><?=$seo['city']?><?=($seo['state']!='')?', '.$seo['state']:''?></a></h1>
			</li>
			<li class="headline-phone">
				<h4><a href="tel:<?=get_phone_number()?>" class="link-inverse link-decorate link-showoff"><?=get_phone_number()?></a></h4>
			</li>
			<li class="headline-link hidden-phone hidden-tablet">
				<h4><a href="" class="quick-estimate">Quick Estimate</a></h4>
			</li>
		</ul>
	</div>
</section>
<!-- / Headline -->
