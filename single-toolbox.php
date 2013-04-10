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

<?
load_template(TOOLBOX_BASE_DIR.'/toolbox-'.$post->post_name.'.php', false);
?>

<div class="project-template hide">
  <?php
    // Template for new project
    $post = new stdClass();
    load_template(TOOLBOX_TEMPLATES.'/edit-showroom.php', false);
  ?>
</div>

<?php get_footer('toolbox'); ?>
