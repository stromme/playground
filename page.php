<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * Description:
 * @package Hatch
 * @subpackage 
 * @since 
 */

get_header();

the_post();
the_content();

get_footer();

?>