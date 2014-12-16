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

<?php load_template(TOOLBOX_BASE_DIR.'/toolbox-'.$post->post_name.'.php', false); ?>

<!-- Request site update -->
<div class="big-modal">
  <?php
  ob_start();
  load_template(TOOLBOX_TEMPLATES.'/request-edit-site.php', false);
  $request_edit_site = ob_get_contents();
  ob_end_clean();
  $params = array(
    'id' => 'request-edit-site',
    'buttons' => array(
      array('text'=>'Cancel', 'function'=>'close'),
      array('text'=>'Submit', 'class'=>'btn-primary action-submit', 'attributes'=>"data-nonce=\"".wp_create_nonce('request-edit-site-'.date('Ymd'))."\"")
    ),
    'title' => 'Request edit site',
    'content' => $request_edit_site
  );
  echo generate_modal($params);
  ?>
</div>
<!-- / request site update -->

<!-- Tag photo Modal -->
<div class="modal hide fade" id="tag-media">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>What are we looking at?</h3>
	</div>
	<div class="modal-body">
		<p>Help us use this photo/document on your web site. Provide a short caption and description.</p>
		<div>
      <input id="media-caption" class="input-block-level" placeholder="Add a caption" type="text">
		</div>
		<div>
			<textarea id="media-description" class="input-block-level" placeholder="Add a desciption"></textarea>
		</div>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Cancel</a>
		<a href="javascript:void(0);" class="btn btn-success save">Save</a>
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

<!-- Share project modal -->
<div class="share-project-template hide">
	<div class="share-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Email photos of this project to your customer</h3>
	</div>
	<div class="share-body">
		<div class="input-prepend">
      <span class="add-on"><i class="icon-envelope"></i></span>
      <input class="input-block-level lowercase-only" id="customer-email" placeholder="Customer's email" validation="not-empty email" type="text" value="" />
		</div>
		<div class="well bumper">
      <label for="customer-message">Email message</label>
      <?php
      $tb_company = get_option('tb_company');
      $company_name = stripslashes((isset($tb_company['name']) && ''!=$tb_company['name'])?$tb_company['name']:'us');
      ?>
			<textarea class="input-block-level" id="customer-message" placeholder="Message to customer" validation="not-empty" rows="5">We just finished your project and wanted to share how great things turned out. Here's a few photo's of the completed work. Thanks again for choosing <?=$company_name?>, please don't hesitate to contact us if you need anything else.</textarea>
		</div>
		<p>Your customer will also be emailed a link to review this project.</p>
	</div>
	<div class="share-footer">
    <a href="#" class="btn btn-primary action-send" data-nonce="<?=wp_create_nonce('send-email-'.date('Ymd'))?>">Send email</a>
    <a href="#" class="btn action-preview" data-nonce="<?=wp_create_nonce('preview-email-'.date('Ymd'))?>">Preview</a>
    <a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Skip email</a>
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

<!-- Affiliate modal -->
<?php load_template(TOOLBOX_TEMPLATES.'/affiliate-box.php', false); ?>
<!-- / modal -->

<?php get_footer('toolbox'); ?>
