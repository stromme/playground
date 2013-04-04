<?php
/* Get the human readable time stamp for the review */
//$h_time = tb_format_time($post->post_modified_gmt);
//$h_time_short = tb_format_time_short($post->post_modified_gmt);

//$h_time = '<span class="e">'.ucfirst($post->post_status).' </span><span class="e">'.$h_time.'</span><span class="c">'.$h_time_short.'</span>';
$rating = get_comment_meta($post->ID, 'rating', true);

?>

<li class="bumper-bottom">
  <div class="author-callout author-callout-border">
    <cite><?=$post->post_title?></cite> says<b class="author-callout-border-notch notch"></b><b class="notch"></b>
    <div class="pull-right review-rating" data-score="<?=$rating?>"></div>
  </div>
  <p class="bumper-bottom">"<?=$post->post_content?>"
  </p>
  <div class="pen-stroke"></div>
</li>