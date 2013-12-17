<?php
/**
 * Description: Banner Module - default view.
 * A module to display a carousel of projects or manually entered image and content.
 *
 * @package 
 * @subpackage 
 * @since 
 */
?>

<div class="banner">
	<div class="banner-photo">
		<img src="<?php echo THEME_IMAGES; ?>temp/banner.jpg">	
	</div>
	<div class="banner-review">
		<blockquote>
			<p>"Couldn't be happier. They showed up on time and did a fantastic job. We'll call again for sure."</p>
			<p class="banner-author"><cite>Rene C.</cite> - Bethseda, CA</p>
		</blockquote>
		<div class="fixed-bottom">
			<ul class="share-it">
				<li class="write-review"><a href=""><i class="icon-full-conversation"></i><span> Write your review</span></a></li>
				<!-- Commented out for local development -->
				<li class="social-network"><div class="fb-like" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false" data-font="verdana" data-action="like"></div></li>
        <?php $tw = get_site_option('tb_twitter_share'); ?>
				<li class="social-network"><a href="https://twitter.com/share" class="twitter-share-button" <?=(isset($tw['account'])?'data-via="'.$tw['account'].'" data-related="'.$tw['account'].'"':'')?> <?=(isset($tw['hashtags'])?'data-hashtags="'.$tw['hashtags'].'"':'')?>>Tweet</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></li>
			</ul>
		</div>
	</div>
</div>
<div class="curved-shadow">
	<img src="<?php echo THEME_IMAGES; ?>backgrounds/bottom-shadow.png" />
</div>
