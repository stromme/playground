<?php global $review; ?>
<li class="bumper-bottom">
	<div class="author-callout author-callout-border">
		<cite><?=$review->name?></cite> says<b class="author-callout-border-notch notch"></b><b class="notch"></b>
		<div class="pull-right review-rating" data-score="<?=$review->rating?>"></div>
	</div>
	<p class="bumper-bottom">"<?=$review->content?>"
	</p>
	<div class="pen-stroke"></div>
</li>