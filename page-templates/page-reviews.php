<?php
/**
 * Template Name: Reviews
 * Description: 
 *
 * @package WordPress
 * @subpackage Hatch
 * @since 
 */

get_header();
$company = get_option('tb_company');
// Get all pinned reviews
$args = array(
  'number'  => 3,
  'post_id' => 0,
  'status'  => 'approve',
  'meta_query' => array(
    'relation' => 'AND',
    array(
      'key' => 'pinned',
      'value' => '',
      'type' => 'char',
      'compare' => '!='
    )
  )
);
$comments = get_comments($args);
$reviews = array();
$pinned_keys = array();
foreach($comments as $comment){
  $listed_comment = new stdClass();
  $listed_comment->id = $comment->comment_ID;
  $listed_comment->name = $comment->comment_author;
  $listed_comment->content = $comment->comment_content;
  $listed_comment->pinned = get_comment_meta($comment->comment_ID, 'pinned', true);
  $listed_comment->rating = get_comment_meta($comment->comment_ID, 'rating', true);
  array_push($reviews, $listed_comment);
  array_push($pinned_keys, $comment->comment_ID);
}
// Sort by pinned
if(count($reviews)>1){
  if(!function_exists('pinsort')){
    function pinsort($a,$b) {
      return $a->pinned>$b->pinned;
    }
  }
  uasort($reviews, "pinsort");
}

$args = array(
  'number'  => 10,
  'post_id' => 0,
  'orderby' => 'modified',
  'order'   => 'DESC',
  'status'  => 'approve'
);
$comments = get_comments($args);
$all_reviews = array();
foreach($comments as $comment){
  $listed_comment = new stdClass();
  $listed_comment->id = $comment->comment_ID;
  $listed_comment->name = $comment->comment_author;
  $listed_comment->content = $comment->comment_content;
  $listed_comment->rating = get_comment_meta($comment->comment_ID, 'rating', true);
  if($listed_comment->rating=='') $listed_comment->rating = 0;
  array_push($all_reviews, $listed_comment);
}

?>

<!-- Wrap the page in .container to centre the content and keep it at a max width -->
<div class="container gentle-shadow top-radius">
	
	<section class="banner-title page-left page-right top-radius">
		<div class="bumper-top bumper-bottom center">
			<h2><?php echo ( get_the_title() != 'Reviews' ? get_the_title() : $company['name'] . ', loved in your neighborhood.'); ?></h2>
		</div>
	</section>
	<section class="bg-white page-left page-right bumper-bottom-medium bumper-top-medium">
		<ul id="reviews-list" class="reviews-list">
      <?php
        global $review;
        if(count($reviews)>0){
          foreach($reviews as $review){
            get_template_part('templates/list', 'review');
          }
        }
        if(count($all_reviews)>0){
          foreach($all_reviews as $review){
            if(!in_array($review->id, $pinned_keys)){
              get_template_part('templates/list', 'review');
            }
          }
        }
      ?>
		</ul>
	</section>
	
<script type="text/javascript">
  $(document).ready(function(){
    $('.review-rating').raty({'readOnly': true, 'score': function(){return $(this).attr('data-score');}, 'path': ratyimgurl});
  })
</script>
<?php get_footer(); ?>
