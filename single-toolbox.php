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
get_footer();
?>
