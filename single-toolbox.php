<?php
/**
 * Template Name: Toolbox
 * Description: 
 *
 * @package 
 * @subpackage 
 * @since 
 */

get_header('toolbox');
load_template(TOOLBOX_BASE_DIR.'/toolbox-'.$post->post_name.'.php', false);
// get_template_part(TOOLBOX_BASE_DIR.'/toolbox',  $post->post_name);
get_footer();
?>
