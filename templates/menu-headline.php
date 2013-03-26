<?php
/**
 * Template Name: Headline
 * Description: Fixed to top page headline and call to action
 *
 * @package 
 * @subpackage 
 * @since 
 */

$blog_prefix = '';
if ( is_multisite() && !is_subdomain_install() && is_main_site() )
  $blog_prefix = '/blog';

?>

<!-- Headline - Fixed to top of page
==================================================
-->
<section class="fixed-top">
	<div class="container headline">
		<ul>
			<li class="headline-title green-man-45">
				<h1 class="multi-line">Awarded <?=date('Y')?> <b>Best Window Cleaners</b> in <a href="<?=get_home_url().$blog_prefix."/locations/"?>" class="link-inverse link-decorate link-showoff" data-toggle="tooltip" data-placement="bottom" title="Visit another location">Seattle</a></h1>
			</li>
			<li class="headline-phone">
				<h4><a href="">(898) 123-1234</a></h4>
			</li>
			<li class="headline-link hidden-phone hidden-tablet">
				<h4><a href="" class="quick-estimate">Quick Estimate</a></h4>
			</li>
		</ul>
	</div>
</section>
<!-- / Headline -->
