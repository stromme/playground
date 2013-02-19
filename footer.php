<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
  <!-- Tag edit project Modal -->
  <div class="project-template hide">
    <?php
      // Template for new project
      $post = null;
      load_template(TOOLBOX_TEMPLATES.'/edit-showroom.php', false);
    ?>
  </div>
  <div class="modal hide fade project-modal" id="toolbox-project">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h3>New Project</h3>
    </div>
    <div class="modal-body"></div>
    <div class="modal-footer">
      <a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Cancel</a>
      <a href="javascript:void(0);" class="btn btn-success save">Save</a>
    </div>
  </div>
  <!-- / modal -->

	</div><!-- #main .wrapper -->
	<footer id="colophon" role="contentinfo">
		<div class="site-info">
			<?php do_action( 'twentytwelve_credits' ); ?>
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'twentytwelve' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'twentytwelve' ); ?>"><?php printf( __( 'Proudly powered by %s', 'twentytwelve' ), 'WordPress' ); ?></a>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>