<?php
/**
 * The default front page template for displaying content. 
 *
 * @package WordPress
 * @subpackage Hatch
 * @since 
 */

get_header(); 

?>

<header class="container">
	<div class="row">
		<div class="span3 logo">
			<img src="<?php echo THEME_IMAGES; ?>temp/window-cleaning-dot-com-logo.png">
		</div>
		<nav class="navbar-static-top pull-right">
			<div class="award">
				<h3 class="pull-right">Awarded best Window Cleaners in Seattle</h3>
				<img src="<?php echo THEME_IMAGES; ?>temp/window-cleaning-award.png">
			</div>
			
			<ul class="nav nav-pills pull-right">
				<li><a href=""><h4>Services</h4></a></li>
				<li><a href=""><h4>Services</h4></a></a></li>
				<li><a href=""><h4>Services</h4></a></a></li>
			</ul>
		
		</nav>
	</div>
</header>


<nav class="cta navbar-fixed-bottom">
	<div class="container cta-top">
		<div class="row">
			<div class="offset1 span4 cta-paper-top">
			</div>
		</div>
	</div>
	<div class="cta-bottom">
		<div class="container">
			<div class="row">
				<div class="offset1 span4 cta-paper-bottom">
					<h2>Questions? Let's chat.</h2>
				</div>
				<div class="span3 cta-call-us">
					<h4><em>Give us a call: (888) 123-1234</em></h4>
				</div>
				<div class="span4 cta-get-price">
					<button class="btn btn-primary">Instant Quote</button>
				</div>
			</div>
		</div>
	</div>
</nav>


<section class="banner">
	<div class="container">
		<div class="pull-right banner-photo">
			<div>
				<img src="<?php echo THEME_IMAGES; ?>temp/banner.jpg">
			</div>
			<img class="photo-shadow" src="<?php echo THEME_IMAGES; ?>backgrounds/960-shadow.png" alt="" />
			
		</div>
		
		<div class="banner-tag-line">
			<div class="block">
				<div class="centered">
					<h2>"Couldn't be happier. They showed up on time and did a fantastic job."</h2>
				</div>
			</div>
		</div>
	</div>
</section>
	
<section class="headliner bumper">
	<!--<div class="row">
		<div class="offset1">
			<h1>Awarded the 2012 Super Service Award</h1>
		</div>
	</div>-->
		<p class="lead pull-right">We're proud to announce that we've been awarded the Angie's List 2012 award for the best window cleaning.</p>
		<img src="<?php echo THEME_IMAGES; ?>icons/angies-list-super-service-2012-100px.jpg">
		
	
	
</section>

<section class="services">
	<div class="row">
		<ul>
			<li>
				<div>
					<img src="<?php echo THEME_IMAGES; ?>temp/category.png" alt="" />
				</div>
				<h4>Home Window Cleaning ></h4>
			</li>
			<li>
				<div>
					<img src="<?php echo THEME_IMAGES; ?>temp/category.png" alt="" />
				</div>
				<h4>Home Window Cleaning ></h4>
			</li>
			<li>
				<div>
					<img src="<?php echo THEME_IMAGES; ?>temp/category.png" alt="" />
				</div>
				<h4>Home Window Cleaning ></h4>
			</li>
		</ul>
	</div>
</section>

<section class="about-us bumper">
	<div class="row">
		<article class="span8">
			<h2>Why Squeeky Clean Window Washing was awarded Best in Bethesda MD.</h2>
			<p>Yes, Squeeky Clean Window Washing has undergone a rigorous screening process. They have received our top ranking as the best window cleaners in Bethesda Maryland. We are so confident you will be completely satisfied with their window cleaning services that we offer our $1000 Streak Free Guarantee, only through WindowCleaning.com.</p>
		</article>
		<aside class="span4">
			<div class="carousel slide">
				<div class="carousel-inner">
					<blockquote class="item">
						<p>I asked Squeeky Clean to clean my windows and gutters. They did a terrific job on both. The gutters were clogged with dirt and decayed leaves. They cleaned out all the gunk in the gutters. And the windows glowed! Very efficient and client-friendly team. I will use them again next year."</p>
						<small><cite>Marilou Merrill</cite></small>
					</blockquote>
				</div>
				<ol class="carousel-indicators">
					<li></li>
					<li></li>
				</ol>
			</div>
		</aside>
	</div>
</section>
	
	
	




<?php get_footer(); ?>
