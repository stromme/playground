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
				<h1 itemprop="description"><span class="hidden-phone-portrait">Awarded <?=date('Y')?></span> <b>Best Window Cleaners</b> in <a href="<?=get_home_url().get_blog_prefix()."/locations/"?>" class="link-inverse link-decorate link-showoff" data-toggle="tooltip" data-placement="bottom" title="Visit another location"><?=$seo['city']?><span class="hidden-phone-portrait" ><?=($seo['state']!='')?', '.$seo['state']:''?></span></a></h1>
			</li>
			<li class="headline-phone">
				<?php $tb_company = get_option('tb_company'); ?>
			
				<h2 class="white" ><span class="visible-phone-portrait" itemprop="name"><?=esc_html( stripslashes($tb_company['name']))?></span> <a href="tel:<?=tb_format_phone_plain(get_phone_number())?>" class="link-inverse link-decorate link-showoff" itemprop="telephone"><?=get_phone_number()?></a></h2>
			</li>
			<li class="headline-link hidden-phone hidden-tablet" itemscope="http://schema.org/ContactPoint">
				<h2 itemprop="description"><a href="" class="quick-estimate" itemprop="url">Quick Estimate</a></h2>
			</li>
		</ul>
	</div>
</section>
<!-- / Headline -->
