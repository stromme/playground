<?php
/**
 * Template Name: Toolbox
 * Description: 
 *
 * @package 
 * @subpackage 
 * @since 
 */

$MEDIA_PATH = get_bloginfo('template_directory').'/toolbox/images/';

get_header('toolbox');

get_template_part(TOOLBOX_BASE_DIR.'/toolbox',  $post->post_name);

get_footer();
?>
