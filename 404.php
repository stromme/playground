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
			<h2>Sorry...Looks like this page doesn't exist.</h2>
			<h3 class="bumper-top-large"><a href="<?=get_site_url(1)?>">Click here </a> to continue to our site.</h3>
		</div>
	</section>

<?php get_footer(); ?>