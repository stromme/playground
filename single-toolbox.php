<?php
/**
 * Template_Name: Toolbox Single
 * Description: 
 *
 * @package 
 * @subpackage 
 * @since 
 */

get_header('toolbox');

?>

<!-- Tag edit project Modal -->
<div class="big-modal">
  <div class="modal hide fade" id="toolbox-activity">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h3></h3>
    </div>
    <div class="modal-body"></div>
    <div class="modal-footer"></div>
  </div>
</div>
<!-- / modal -->

<!-- Delete media modal -->
<?php
  generate_delete_modal(array(
    'id'=>'delete-media-confirm',
    'buton-id'=>'action-confirm',
    'title'=>'Are you sure?',
    'content'=>'If you delete this media it will be permanently removed from our server.'
  ));
?>
<!-- / modal -->

<?
load_template(TOOLBOX_BASE_DIR.'/toolbox-'.$post->post_name.'.php', false);
?>

<!-- Share project modal -->
<div class="share-project-template hide">
	<div class="share-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Email photos of this project to your customer</h3>
	</div>
	<div class="share-body">
		<div class="input-prepend">
      <span class="add-on"><i class="icon-envelope"></i></span>
      <input class="input-block-level" id="customer-email" placeholder="Customer's email" validation="not-empty email" type="text" value="" />
		</div>
		<div class="well bumper">
      <label for="customer-message">Email message</label>
			<textarea class="input-block-level" id="customer-message" placeholder="Message to customer" validation="not-empty" rows="5">We've just finished your {project-slug}project. We're sending over a few pictures of the completed work. Please don't hesitate to contact us if you need anything else.</textarea>
		</div>
		<p>Your customer will also be emailed a link to review this project.</p>
	</div>
	<div class="share-footer">
    <a href="#" class="btn btn-primary action-send" data-nonce="<?=wp_create_nonce('send-email-'.date('Ymd'))?>">Send email</a>
    <a href="#" class="btn action-preview" data-nonce="<?=wp_create_nonce('preview-email-'.date('Ymd'))?>">Preview</a>
    <a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Skip</a>
	</div>
</div>
<!-- / modal -->

<div class="project-template hide">
  <?php
    // Template for new project
    $post = new stdClass();
    load_template(TOOLBOX_TEMPLATES.'/edit-showroom.php', false);
  ?>
</div>

<?php get_footer('toolbox'); ?>
