<?php
/**
 * Template_Name: Headline
 * Description: Fixed to top page headline and call to action
 *
 * @package 
 * @subpackage 
 * @since 
 */

// Company name to include in titles
$company = get_option('tb_company');

// Location SEO keywords
$seo = get_location_seo();

// Only show state if the city name is not too long
$state = ((strlen($seo['city'])<14 && $seo['state']!='')?', '.$seo['state']:'');

$location = '<a href="'.get_site_url(1).'/locations/" class="link-inverse link-decorate link-showoff" data-toggle="tooltip" data-placement="bottom" title="Visit another location">'.$seo['city'].'<span class="hidden-phone-portrait" >'.$state.'</span></a>';

// Service SEO keywords
$tb_industry = get_option('tb_industry');
$industry = ucwords( str_replace('-', ' ', $tb_industry['industry'] ) );

$keyword = 'Window Cleaners';

if (!is_front_page())
	$keyword = ucwords(get_the_title());
	
// Award
$award = '<span class="hidden-phone-portrait">Awarded '.date('Y').'</span> ';
	
// Default title
if (strlen($location) > 14) {
	$title = '<span class="hidden-phone">'. $award . '</span><b>Best ' . $industry . '</b> in ' . $location;
} else {
	$title = $award . '<b>Best ' . $industry . '</b> in ' . $location;
}

// When taxonomy is not defined, try looking for it
if('cftl-tax-landing' == get_post_type() && !isset($taxonomy)){
  $terms = get_the_terms(get_the_ID(), 'locations');
  if($terms){
    $taxonomy = 'locations';
  }
  else {
    $terms = get_the_terms(get_the_ID(), 'services');
    if($terms){
      $taxonomy = 'services';
    }
  }
}

// Titles for main pages

if ( ( 'cftl-tax-landing' == get_post_type() ) && ( isset($taxonomy) && $taxonomy == 'services' ) ) {
	$title = $award . '<b>Best ' . $keyword . '</b> in ' . $location;
	if (strlen($keyword) > 16)
		$title = '<b>Best ' . $keyword . '</b><span class="hidden-phone-portrait"> in ' . $location . '</span>';
}

if ( ( 'cftl-tax-landing' == get_post_type() ) && ( isset($taxonomy) && $taxonomy == 'locations' ) ) {
  $terms = get_the_terms(get_the_ID(), $taxonomy);
  if($terms && count($terms)>0){
    $keyword = reset($terms)->name;
  }
	$title = $award . '<b>Best ' . $industry . '</b> in <a href="'.get_site_url(1).'/locations/" class="link-inverse link-decorate link-showoff" data-toggle="tooltip" data-placement="bottom" title="Visit another location">'.$keyword.'</a>';
	if (strlen($keyword) > 16)
		$title = '<b>Best ' . $industry . '</b> in <a href="'.get_site_url(1).'/locations/" class="link-inverse link-decorate link-showoff" data-toggle="tooltip" data-placement="bottom" title="Visit another location">'.$keyword.'</a>';
}

if ( is_page( 'reviews' ) ) {
	$title = '<span class="hidden-phone-portrait">' . esc_html( stripslashes($company['name'])) . '</span> <b>Customer Reviews</b>';
}

?>

<!-- Headline - Fixed to top of page
==================================================
-->
<div class="fixed-top fixed-headline">
	<div class="container headline">
		<ul>
			<li class="headline-title green-man-45">
				<h1 itemprop="description"><?=$title?></h1>
			</li>
			<li class="headline-phone">
				<?php $tb_company = get_option('tb_company'); ?>
			
				<h2 class="white" ><span class="visible-phone-portrait" itemprop="name"><?php if (strlen($tb_company['name']) < 17 ) echo esc_html( stripslashes($tb_company['name'])); ?></span> <a href="tel:<?=tb_format_phone_plain(get_phone_number())?>" class="link-inverse link-decorate link-showoff" itemprop="telephone"><?=get_phone_number()?></a></h2>
			</li>
			<li class="headline-link hidden-phone hidden-tablet">
				<h2><a href="" class="quick-estimate">Quick Estimate</a></h2>
			</li>
		</ul>
	</div>
</div>
<!-- / Headline -->
