<?php
/**
 * Description: Pinned Review Module.
 * A module to display pinned reviews.
 *
 * @package
 * @subpackage
 * @since
 */
?>
<div class="reviews-list">
  <?php
    $featurette_reviews = apply_filters('cbtb_load_featurette_reviews', false);
    echo $featurette_reviews['display'];
  ?>
  <div class="vertical-spacing"><a href="./reviews"><span class="glyphicon glyphicon-comment"></span> Read more reviews</a> &nbsp;<span class="dim">&bull;</span>&nbsp; <a href="#" class="write-review">Leave a review</a></div>
</div>