<?php
/**
 * The Template for displaying all single posts.
 * For Hatch, this template will be used to display individual project posts. 
 *
 *
 * @package WordPress
 * @subpackage Hatch
 * @since 
 */

get_header(); ?>



<section class="bg-slate">
	
	<div class="row-fluid bumper-top-large bumper-bottom single-project">
		<div class="span6 page-left">
			<div>		
				<img class="img-polaroid" src="<?php echo THEME_IMAGES; ?>temp/banner.jpg">
			</div>
			<div class="curved-shadow">
				<img src="<?php echo THEME_IMAGES; ?>backgrounds/bottom-shadow.png" />
			</div>
			<ul class="thumbnails align-center bumper-top">
				<li>
					<a href="" class="thumbnail">
						<img src="<?php echo THEME_IMAGES; ?>temp/banner.jpg">
					</a>
				</li>
				<li>
					<a href="" class="thumbnail">
						<img src="<?php echo THEME_IMAGES; ?>temp/banner.jpg">
					</a>
				</li>
			</ul>
			
		</div>
		<div class="span6 page-right">
			<p class="lead">Yes, Squeeky Clean Window Washing has undergone a rigorous screening process. They have received our top ranking as the best window cleaners in Bethesda Maryland. We are so confident you will be completely satisfied with their window cleaning services that we offer our $1000 Streak Free Guarantee, only through WindowCleaning.com.</p>
			<h3 class="bumper-top" ><cite>MC Hammer </cite><small>- Springfield, MA</small></h3>
			
			<div class="bumper-top bumper-bottom">
				<div class="pen-stroke"></div>
			</div>
			
			<ul class="share-it">
				<li class="write-review"><a href=""><i class="icon-full-conversation"></i> Review this project</a></li>
				<!-- Commented out for local development -->
				<li class="social-network"><div class="fb-like" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false" data-font="verdana" data-action="like"></div></li>
				<li class="social-network"><a href="https://twitter.com/share" class="twitter-share-button" data-via="streakfreeclean" data-related="streakfreeclean" data-hashtags="WindowCleaning">Tweet</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></li>
			</ul>
		</div>
	</div>
	
</section>

<section class="bg-slate">
	<div class="row-fluid  bumper-top-medium bumper-bottom-medium">
		<div class="span12">
			<h2 class="blue center">View more of our recent <strong class="green">home window cleaning</strong> projects</h2>
		</div>
	</div>
	<div class="row-fluid">
		<ul class="thumbnails page-right page-left">
			<li class="span4 bg-white">
				<div class="thumbnail">
					<img src="<?php echo THEME_IMAGES; ?>temp/banner.jpg">
					<div class="caption">
						<p>Yes, Squeeky Clean Window Washing has undergone a rigorous screening process. They have received our top ranking as the best window...
						</p>
						<p>
							<a class="btn btn-primary btn-small">Visit Showroom</a> <a class="btn btn-success btn-small">View project</a>
						</p>
					</div>
				</div>
			</li>
			<li class="span4 bg-white">
				<div class="thumbnail">
					<img src="<?php echo THEME_IMAGES; ?>temp/banner.jpg">
					<div class="caption">
						<p>Yes, Squeeky Clean Window Washing has undergone a rigorous screening process. They have received our top ranking as the best window...
						</p>
						<p>
							<a class="btn btn-primary btn-small">Visit Showroom</a> <a class="btn btn-success btn-small">View project</a>
						</p>
					</div>
				</div>
			</li>
			<li class="span4 bg-white">
				<div class="thumbnail">
					<img src="<?php echo THEME_IMAGES; ?>temp/banner.jpg">
					<div class="caption">
						<p>Yes, Squeeky Clean Window Washing has undergone a rigorous screening process. They have received our top ranking as the best window...
						</p>
						<p>
							<a class="btn btn-primary btn-small">Visit Showroom</a> <a class="btn btn-success btn-small">View project</a>
						</p>
					</div>
				</div>
			</li>
		</ul>	
	</div>
</section>

<section class="bg-white">

	<!-- Accolades - Headline Style - Show one or more accolades (Carousel for multiple accolades)
	===============================================================================================
	-->
	
	<div class="row-middle center-align page-left page-right bumper-top bumper-bottom">
		<div class="middle-fixed-small bumper-right">		
			<img src="<?php echo THEME_IMAGES; ?>temp/angies.png" width="150">
		</div>
		<div class="middle">
			<h2> 2012 Angie's list superior service award winner.</h2>
		</div>
	</div>
	<div class="page-left page-right">
		<div class="pen-stroke"></div>
	</div>
	
	<!-- / Accolades -->
	
</section>
	
<?php get_footer(); ?>