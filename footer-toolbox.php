<?php
/**
 * The template for displaying the toolbox footer.
 *
 * Contains footer content and the closing of the
 * .container div element.
 *
 * @package Hatch
 * @subpackage
 * @since
 */
?>
	<!--section class="footer">

	</section-->
<div class="modal fade in" id="toolbox-lock" aria-hidden="false">
  <div class="modal-body">
    <p>We're doing server upgrade right now. This will be scheduled to be done not longer than 24 hours or faster. Please be patient and check a gain in a few hours.</p>
    <p>Thank you.</p>
  </div>
</div>
<div class="toolbox-lock"></div>
<style>
  #toolbox-lock {
    display: block;
    top: 20%;
    position: fixed;
    margin-top: 0;
    z-index: 1029;
  }
  .toolbox-lock {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1028;
    background-color: #000;
    opacity: 0.8;
  }
  .action-new-project {
    display: none;
  }
</style>
</div><!-- / .container -->

<?php wp_footer(); ?>
</body>
</html>