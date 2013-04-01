<?php
/**
 * Template Name: Reviews Page
 * Description: 
 *
 * @package WordPress
 * @subpackage Hatch
 * @since 
 */

get_header();
$company = get_option('tb_company');
$args = array(
  'orderby' => 'modified',
  'order'   => 'DESC',
  'number'  => 10
);
$reviews = get_comments($args);
?>

<!-- Wrap the page in .container to centre the content and keep it at a max width -->
<div class="container gentle-shadow">
	
	<section class="bg-sea margin-left margin-right page-title">
		<div class="bumper-top-medium bumper-bottom-medium bumper-left-large bumper-right-large center">
			<h2 class="white"><?=$company['name']?>, loved in your neighborhood.</h2>
			<div class="pen-stroke-blue"></div>
		</div>
	</section>
	<section class="bg-white page-left page-right bumper-bottom-medium bumper-top-medium">
		<ul class="reviews-list">
      <?php
        if(count($reviews)>0){
          foreach($reviews as $review){
      ?>
			<li class="bumper-bottom">
				<div class="author-callout author-callout-border">
					<cite><?=$review->comment_author?></cite> says<b class="author-callout-border-notch notch"></b><b class="notch"></b>
					<!-- star rating needs to be added to float right in this div -->
				</div>
				<p class="bumper-bottom">"<?=$review->comment_content?>"
				</p>
				<div class="pen-stroke"></div>
			</li>
      <?php
          }
        }
      ?>
		</ul>
		
		
	
	</section>
	

<?php get_footer(); ?>
