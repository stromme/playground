<?php global $review; ?>
<li class="bumper-bottom" itemprop="review" itemscope="http://schema.org/Review">
	<div class="author-callout author-border-callout">
    <div class="pull-right review-rating" data-score="<?=$review->rating?>"></div>
    <span class="hide" itemprop="reviewRating"><?=$review->rating?></span>
    <div>
		  <cite itemprop="author"><?=$review->name?></cite> <?=get_comment_says($review->name)?><b class="author-border-notch notch"></b><b class="notch"></b>
    </div>
	</div>
	<p class="bumper-bottom">"<span itemprop="reviewBody"><?=$review->content?></span>"
	</p>
	<div class="pen-stroke"></div>
</li>