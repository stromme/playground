<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * .container div element.
 *
 * @package Hatch
 * @subpackage 
 * @since 
 */
restore_current_blog();
?>
	<section class="footer">
		<img src="<?php echo get_header_image(); ?>">
		<h3 class="bumper-bottom bumper-top">Like to chat? Call our team anytime at <?=get_phone_number()?> or <a href="javascript:void(0);" class="quick-estimate <?=apply_filters('apply_responsibid', false);?>">get an online estimate.</a></h3>
		<p class="footer-links"><a href="<?=home_url()?>/services">Services</a><a href="<?=home_url()?>/showroom">Showroom</a><a href="<?=home_url()?>/reviews">Reviews</a></p>
		<p><small><?php echo get_bloginfo ( 'description' ) ?> | Copyright <?=date('Y')?> </small></p>
	</section>

</div><!-- / .container -->
<? get_template_part('templates/modal', 'review'); ?>
<? get_template_part('templates/modal', 'lead'); ?>
<?php wp_footer(); ?>
<?=get_google_remarketing_code();?>
</body>
</html>