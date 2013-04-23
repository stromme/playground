<?php global $review; ?>
<li class="bumper-bottom" itemprop="review" itemscope="http://schema.org/Review">
	<div class="author-callout author-border-callout">
		<cite itemprop="author"><?=$review->name?></cite> says
		<b class="author-border-notch notch"></b>
		<b class="notch"></b>
		<div class="pull-right review-rating" data-score="<?=$review->rating?>"></div>
	</div>
	<p class="bumper-bottom" itemprop="description">"<?=$review->content?>"
	</p>
	<div class="pen-stroke"></div>
</li>