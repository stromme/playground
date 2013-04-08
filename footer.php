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
?>
	<section class="footer">
		<img src="<?php echo get_header_image(); ?>">
		<h3 class="bumper-bottom bumper-top">Like to chat? Call our team anytime at (123) 123-1234 or <a href="">get an online estimate.</a></h3>
		<p class="footer-links"><a href="">Services</a><a href="">Showroom</a><a href="">Reviews</a></p>
		<p><small><?php echo get_bloginfo ( 'description' ) ?> | Copyright 2013 </small></p>
	</section>

</div><!-- / .container -->
<? get_template_part('templates/modal', 'review'); ?>
<? get_template_part('templates/modal', 'lead'); ?>
<?php wp_footer(); ?>
</body>
</html>