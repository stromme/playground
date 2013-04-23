<?php
/**
 * Template_Name: Headline
 * Description: Fixed to top page headline and call to action
 *
 * @package 
 * @subpackage 
 * @since 
 */

// Location SEO keywords

$seo = get_location_seo();
$state = ( ( $seo['state'] != '' ) ? ', ' . $seo['state'] : '' );
$location = '<a href="'.get_site_url(1).'/locations/" class="link-inverse link-decorate link-showoff" data-toggle="tooltip" data-placement="bottom" title="Visit another location">'.$seo['city'].'<span class="hidden-phone-portrait" >'.$state.'</span></a>';

// Service SEO keywords

$keyword = 'Window Cleaners';

if (!is_front_page())
	$keyword = ucwords(get_the_title());
	
// Award

$award = '<span class="hidden-phone-portrait">Awarded '.date('Y').'</span> ';
	
// Build the header title

$title = $award . '<b>Best ' . $keyword . '</b> in ' . $location;

if (strlen($keyword) > 16)
	$title = '<b>Best ' . $keyword . '</b><span class="hidden-phone-portrait"> in ' . $location . '</span>';

?>

<!-- Headline - Fixed to top of page
==================================================
-->
<section class="fixed-top">
	<div class="container headline">
		<ul>
			<li class="headline-title green-man-45">
				<h1 itemprop="description"><?=$title?></h1>
			</li>
			<li class="headline-phone">
				<?php $tb_company = get_option('tb_company'); ?>
			
				<h2 class="white" ><span class="visible-phone-portrait" itemprop="name"><?=esc_html( stripslashes($tb_company['name']))?></span> <a href="tel:<?=tb_format_phone_plain(get_phone_number())?>" class="link-inverse link-decorate link-showoff" itemprop="telephone"><?=get_phone_number()?></a></h2>
			</li>
			<li class="headline-link hidden-phone hidden-tablet">
				<h2><a href="" class="quick-estimate">Quick Estimate</a></h2>
			</li>
		</ul>
	</div>
</section>
<!-- / Headline -->
