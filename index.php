<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Hatch
 * @since 
 */

get_header(); 

?>

<section>

	<? get_template_part('templates/module', 'banner'); ?>
		
</section>

<section class="bg-white">

	<? get_template_part('templates/module', 'accolade-headline'); ?>
		
</section>

<section class="bg-white bumper-bottom bumper-top page-left page-right">
	
	<h2 class="blue center">What we're <strong class="green">really</strong> good at.</h2>

</section>

<section class="bg-slate bumper-bottom">
	
	<? get_template_part('templates/module', 'link-grid'); ?>
	
</section>

<section class="bg-white bumper-top-medium">
	<div class="row-fluid">
		<div class="span5">
			<h2 class="page-left">Don't take any chances, we are fully insured and our work is 100% guaranteed.</h2>
		</div>
		
		<div class="span7">
			
			<!-- Accolades - Featurette style - Show one or more accolades 
			================================================================================================
			-->
			<div class="row-middle ">
				<div class="middle-fixed-small bumper-right">
					<img src="<?php echo THEME_IMAGES; ?>temp/window-cleaning-guarantee-small.png" width="200">
				</div>
				<div class="middle">
					<h4 class="green">Hassle free money back guarantee.</h4>
					<p>We’re proud to offer Bethesda's only $1000 Streak Free Guarantee. If you don’t love our work, we’ll refund up to $1000.</p>
				</div>
			</div>
			
			<div class="row-middle page-right">
				<div class="middle-fixed-small">
					<img src="<?php echo THEME_IMAGES; ?>temp/insured-window-cleaning.png" width="130">
				</div>
				<div class="middle">
					<h4 class="green">We carry $1,000,000 in liability insurance.</h4>
					<p>Protect your home and family. Only work with fully insured WindowCleaning.com professionals.</p>
				</div>
			</div>
			<!-- / Accolades -->
			
		</div>
	</div>		
</section>

<section class="bg-white page-left page-right">
	<div class="row-fluid">
		<div class="span12">
		
			<!-- Reviews - Using the inverted color style
			===========================================================================================================
			-->
			
			<div class="review review-invert bumper-top-large bumper-bottom-large ">
				<blockquote class="center well well-blue well-has-shadow">
					<p>"My assistant found Ernie of Quality Window Cleaning on the web. He gave us a quote and did a test clean of our windows. We found him to be quick and efficient and he was even able to get rid of some stubborn water stains. Needless to say, we have been very satisfied with his work and his price and would recommend him to other businesses"
					</p>
					<p class="citation"><cite>MC Hammer </cite><span class="author-location">~ Springfield, MA</span></p>
					<a href="" class="review-link">Read more reviews</a>
				</blockquote>
				<div class="curved-shadow">
					<img src="<?php echo THEME_IMAGES; ?>backgrounds/bottom-shadow.png" />
				</div>
			</div>
		</div>
	</div>
</section>

<section class="bg-sky page-right page-left">

	<!-- Begin content editable region of page -->

	<!-- Featurette - Title and text vertical middle aligned with a photo or icon
	=============================================================================
	-->
	
	<div class="row-middle bumper-top-large">
		<div class="middle6 bumper-right-large">		
			<img class="img-polaroid" src="<?php echo THEME_IMAGES; ?>temp/banner.jpg">
		</div>
		<div class="middle">
			<h2 class="">Why Squeaky Clean was awarded best in Los Angeles, CA.</h2>
			<p class="blue">Yes, Squeeky Clean Window Washing has undergone a rigorous screening process. They have received our top ranking as the best window cleaners in Bethesda Maryland. We are so confident you will be completely satisfied with their window cleaning services that we offer our $1000 Streak Free Guarantee, only through WindowCleaning.com.</p>
		</div>
	</div>
	
	<!-- / Featurette -->

	<!-- Featurette - Title and text vertical middle aligned with a photo or icon
	====================================================================
	-->
	
	<div class="row-middle bumper-top-large">
		<div class="middle">
			<h2 class="">Why Squeaky Clean was awarded best in Los Angeles, CA.</h2>
			<p class="blue">Yes, Squeeky Clean Window Washing has undergone a rigorous screening process. They have received our top ranking as the best window cleaners in Bethesda Maryland. We are so confident you will be completely satisfied with their window cleaning services that we offer our $1000 Streak Free Guarantee, only through WindowCleaning.com.</p>
		</div>
		
		<div class="middle6 bumper-right-large">		
			<img class="img-polaroid" src="<?php echo THEME_IMAGES; ?>temp/banner.jpg">
		</div>
	</div>
	
	<!-- / Featurette -->
	
	<!-- End Content editable region of page -->

	<!-- Awarded Best - Only for wc.com members
	===========================================
	-->

	<div class="bumper-bottom-large bumper-top-large">
		<div class="well-blue well well-has-shadow">
			<div class="clearfix">
				<h2 class="white center ">What does the WindowCleaning.com award actually mean?</h2>
				<p class="blueLightest bumper-top">
					WindowCleaning.com is a national network of the <strong>best window cleaners</strong> in each city. In most cities, <strong>only one window cleaner is chosen out of hundreds</strong> of window cleaners! Each window cleaner is interviewed personally by one of our team. We verify their level of experience, if they are properly insured, their reputation in the industry, and how their customers feel about the service they provide. Then we choose the best.
					
					You can be sure, that by choosing a WindowCleaning.com awarded member, you are choosing the best. And to back it up, all WindowCleaning.com members offer our no hassle <strong>$1000 Streak Free Guarantee!</strong>
				</p>
				<div class="center">
					<div class="btn-group">
						<button class="btn btn-primary btn-large hidden-phone">Call us  (233) 123-1234</button>
						<button class="btn btn-success btn-large">Quick Online Estimate</button>
					</div>
				</div>
			</div>
			
		</div>
		<div class="curved-shadow">
			<img src="<?php echo THEME_IMAGES; ?>backgrounds/bottom-shadow.png" />
		</div>
	</div>
		
	<!-- / Awarded Best -->	
		
</section>

<section class="bg-white bumper-top-medium bumper-bottom-medium">
	<div class="row-fluid">
		<div class="span5">
			<h2 class="page-left bumper-top">We're proud to be recognized by the best organizations in the window cleaning industry.</h2>
		</div>
		
		<div class="span7">
			
			<!-- Accolades - Featurette style - Show one or more accolades 
			==============================================================
			-->
			<div class="row-middle  page-right">
				<div class="middle-fixed-small">
					<img src="<?php echo THEME_IMAGES; ?>temp/window-cleaning-guarantee-small.png" width="200">
				</div>
				<div class="middle">
					<h4 class="green">Window Cleaning Resource Association</h4>
					<p>We’re proud to offer Bethesda's only $1000 Streak Free Guarantee. If you don’t love our work, we’ll refund up to $1000.</p>
				</div>
			</div>
			
			<div class="row-middle page-right">
				<div class="middle-fixed-small">
					<img src="<?php echo THEME_IMAGES; ?>temp/insured-window-cleaning.png" width="130">
				</div>
				<div class="middle">
					<h4 class="green">Internation Window Cleaners Association</h4>
					<p>Protect your home and family. Only work with fully insured WindowCleaning.com professionals.</p>
				</div>
			</div>
			
			<div class="row-middle page-right">
				<div class="middle-fixed-small">
					<img src="<?php echo THEME_IMAGES; ?>temp/insured-window-cleaning.png" width="130">
				</div>
				<div class="middle">
					<h4 class="green">Better Business Bureau</h4>
					<p>Protect your home and family. Only work with fully insured WindowCleaning.com professionals.</p>
				</div>
			</div>
			
			<!-- / Accolades -->
			
		</div>
	</div>		

	<div class="row-fluid">
		<div class="span12">
			
			<!-- Review 
			========================================================
			-->
			
			<!--<div class="review page-left page-right bumper-top-medium">
				<blockquote class="center well">
					<p>"My assistant found Ernie of Quality Window Cleaning on the web. He gave us a quote and did a test clean of our windows. We found him to be quick and efficient and he was even able to get rid of some stubborn water stains. Needless to say, we have been very satisfied with his work and his price and would recommend him to other businesses."
					</p>
					<small><cite>MC Hammer </cite><span class="author-location">~ Springfield, MA</span></small>
					<a href="" class="review-link">Read more reviews</a>
				</blockquote>
			</div>-->
			
			<!-- Reviews -Using the inverted color style
			===========================================================================================================
			-->
			
			<div class="review review-invert page-left page-right bumper-top-large">
				<blockquote class="center well well-blue well-has-shadow">
					<p>"My assistant found Ernie of Quality Window Cleaning on the web. He gave us a quote and did a test clean of our windows. We found him to be quick and efficient and he was even able to get rid of some stubborn water stains. Needless to say, we have been very satisfied with his work and his price and would recommend him to other businesses"
					</p>
					<p class="citation"><cite>MC Hammer </cite><span class="author-location">~ Springfield, MA</span></p>
					<a href="" class="review-link">Read more reviews</a>
				</blockquote>
				<div class="curved-shadow">
					<img src="<?php echo THEME_IMAGES; ?>backgrounds/bottom-shadow.png" />
				</div>
			</div>
			
		</div>
	</div>		
</section>

<section class="bg-white">
	<div class="row-fluid">
		<div class="span12">
			
			<!-- Hero Module -  JumboTron style - Giant image with a headline text and citation
			===========================================================================================================
			-->
			
			<div class="jumbotron hidden-phone" style="background: url('<?php echo THEME_IMAGES; ?>temp/ChicagoSkyline.jpg'); background-size: cover;">
				<h2 class="white jumbo loud page-left page-right bumper-bottom">"Thanks Chicago, for 37 great years and over 12,000 happy customers."</h2>
				<cite class="white light-weight">John Carey, Owner of Streak Free Clean</cite> 
			</div>
			
		</div>
	</div>
</section>


<section class="bg-slate page-left page-right bumper-top-large bumper-bottom-large">
	<div class="row-fluid">
		<div class="span8">
			
			<!-- Address Module - Company address and Google map
			=====================================================
			-->
			
			<div class="pull-left bumper-right-medium bumper-bottom">
				<img class="img-polaroid" src="http://maps.google.com/maps/api/staticmap?center=North+Bethesda,5703+Luxemburg+Street%2C+Apt.100,MD,20852&amp;zoom=9&amp;size=270x210&amp;maptype=roadmap&amp;markers=color:blue%7Clabel:A%7CNorth+Bethesda,5703+Luxemburg+Street%2C+Apt.100,MD,20852&amp;sensor=false" itemprop="image">
			</div>
			<div class="">
				<h3 class="light-weight">Come say hello...</h3>
				<address>
				  <strong>Streak Free Clean</strong><br>
				  795 Folsom Ave, Suite 600<br>
				  San Francisco, CA 94107<br>
				  <abbr title="Phone">P:</abbr> (123) 456-7890
				</address>
				 
				<address>
				  <strong>John Smith</strong><span class="grayLight">, Owner</span><br>
				  <a href="mailto:#">first.last@example.com</a>
				</address>
			</div>
				
			<!-- / Address -->
				
		</div>
		<div class="span4">
		
			<!-- Service area Module - List of locations serviced
			=====================================================
			-->
			
			<div>
				<h3 class="light-weight">Were we work</h3>
				<ul>
					<li>Cincinatti</li>
				</ul>
			</div>
			
			<!-- / Service area -->
			
		</div>
	</div>
</section>

	
	
	
<!--<section class="bg-slate">
	<div class="row-fluid">
		<div class="span4">
		
			<div class="page-left center">
				<h2>Only one in Cincinatti.</h2>
				<p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</p>
				<p><a class="btn" href="#">View details &raquo;</a></p>
			</div>
			
		</div>
		<div class="span4">
		
			<div class="center">
				<h2>5 star rating</h2>
				<p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
				<p><a class="btn" href="#">View details &raquo;</a></p>
			</div>
			
		</div>
		<div class="span4">
		
			<div class="page-right center">
				<h2>Heading</h2>
				<p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
				<p><a class="btn" href="#">View details &raquo;</a></p>
			</div>
			
		</div>
	</div>
</section>	
-->
<!--
<section class="bg-slate">
	<div class="row">
	
		<div class="offset1 span5">
			<h3 class="light-weight sub-title">What we are great at</h3>
			<ul class="link-grid small-grid">
				<li>
					<div class="grid-thumb">
						<nav>
							<a href=""><i class="icon-picture icon-white"></i> Showroom</a>
							<a href=""><i class="icon-info-sign icon-white"></i> Learn more</a>
						</nav>
						<img src="<?php echo THEME_IMAGES; ?>temp/category.png" alt="" />
					</div>
					<a href="#">Home Window Cleaning</a>
				</li>
				<li>
					<div class="grid-thumb">
						<nav>
							<a href=""><i class="icon-picture icon-white"></i> Showroom</a>
							<a href=""><i class="icon-info-sign icon-white"></i> Learn more</a>
						</nav>
						<img src="<?php echo THEME_IMAGES; ?>temp/category.png" alt="" />
					</div>
					<a href="#">Home Window Cleaning</a>
				</li>
				<li>
					<div class="grid-thumb">
						<nav>
							<a href=""><i class="icon-picture icon-white"></i> Showroom</a>
							<a href=""><i class="icon-info-sign icon-white"></i> Learn more</a>
						</nav>
						<img src="<?php echo THEME_IMAGES; ?>temp/category.png" alt="" />
					</div>
					<a href="#">Home Window Cleaning</a>
				</li>
			</ul>
		</div>
		
		<div class="span5">
			<h3 class="light-weight">In the news</h3>
			<ul class="rich-list">
				<li  class="image-bullet" style="background: url('<?php echo THEME_IMAGES; ?>temp/cnet.png') no-repeat;">
					<h5>JOHN DAVIDSON, CNET</h5>
					<p>Simply the best customer service in Chicago...</p>
					<a href="#">cnet.com</a>
				</li>
				<li  class="image-bullet" style="background: url('<?php echo THEME_IMAGES; ?>temp/cnet.png') no-repeat;">
					<h5>JOHN DAVIDSON, CNET</h5>
					<p>Simply the best customer service in Chicago...</p>
					<a href="#">cnet.com</a>
				</li>
			</ul>
		</div>
		
	</div>
</section>-->

<!--	
<section class="why-best bg-slate">
	<div class="row section-header">
		<div class=" offset1 span5">
			<h1 class="light-weight">Keep smiling, we're guaranteed.</h2>
			<!--<p>All you need to do is change the temperature for a few days to teach Nest. After that Nest Sense™ learns about you and your home and starts activating features to save you more energy.
			</p>--*>
		</div>
		<div class="offset1 span5">
			<img src="<?php echo THEME_IMAGES; ?>temp/why-best.png" alt="" />
		</div>
	</div>
	<div class="row highlites">
		<div class="offset1 span10">
			<div class="row highlites-inner">
				<aside class="span4 offset2 tower">
					<img src="<?php echo THEME_IMAGES; ?>temp/window-cleaning-guarantee-small.png" alt="" />
					<h4 class="">$1000 Streak free guarantee</h4>
					<p>We’re proud to offer Bethesda's only $1000 Streak Free Guarantee. If you don’t love our work, we’ll refund up to $1000.</p>
				</aside>
				<aside class="span4 offset1 tower">
					<img src="<?php echo THEME_IMAGES; ?>temp/window-cleaning-guarantee-small.png" alt="" />
					<h4 class="light-weight">$1000 Streak free guarantee</h4>
					<p>We’re proud to offer Bethesda's only $1000 Streak Free Guarantee. If you don’t love our work, we’ll refund up to $1000.</p>
				</aside>
			</div>
		</div>
	</div>
</section>

<section class="about-us">
	<div class="row">
		<article class="offset1 span7">
			<div class="section-header">
				<h2 class="light-weight">Why Squeeky Clean Window Washing was awarded Best in Bethesda MD.</h2>
			</div>
			<p>Yes, Squeeky Clean Window Washing has undergone a rigorous screening process. They have received our top ranking as the best window cleaners in Bethesda Maryland. We are so confident you will be completely satisfied with their window cleaning services that we offer our $1000 Streak Free Guarantee, only through WindowCleaning.com.</p>
		</article>
		<aside class="span4 reviews-carousel">
			<blockquote >
				<p>I asked Squeeky Clean to clean my windows and gutters. They did a terrific job on both. The gutters were clogged with dirt and decayed leaves. They cleaned out all the gunk in the gutters. And the windows glowed! Very efficient and client-friendly team. I will use them again next year."</p>
				<small><cite>Marilou Merrill</cite></small>
			</blockquote>
		</aside>
	</div>
</section>-->
	
	
		
<? get_template_part('templates/modal', 'review'); ?>
<? get_template_part('templates/modal', 'lead'); ?>



<?php get_footer(); ?>