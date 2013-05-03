<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Hatch
 * @since 
 */

get_header(); ?>

	<section class="bg-white gentle-shadow">
		<div class="center page-left page-right bumper-top-large bumper-bottom-large">
			<h2>Hmmm...Well this page used to be here.</h2>
			<h3 class="bumper-top-large">Barring any miraculous re-appearance of what was sure to have been a tremendous viewing experience, it may be best that you <a href="<?=get_site_url(1)?>">click this link</a> and visit a page that still exists.</h3>
		</div>
	</section>

<?php get_footer(); ?>