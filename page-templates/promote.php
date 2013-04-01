<?php
/**
 * Template Name: Promotion
 * Description: 
 *
 * @package WordPress
 * @subpackage Hatch
 * @since 
 */

get_header(); 
/*
?>
<section>

	<!-- Hero Module -  JumboTron style - Giant image with a headline text and citation
	===========================================================================================================
	-->
	
	<div class="jumbotron" style="background: url('<?php echo THEME_IMAGES; ?>temp/ChicagoSkyline.jpg'); background-size: cover;">
		<h2 class="white jumbo loud page-left page-right bumper-bottom">"Thanks Chicago, for 37 great years and over 12,000 happy customers."</h2>
		<cite class="white light-weight">John Carey, Owner of Streak Free Clean</cite> 
	</div>

	<? // get_template_part('templates/module', 'banner'); ?>
		
</section>	

<section class="bg-white bumper-top-small">

	<? get_template_part('templates/module', 'accolade-headline'); ?>
		
</section>

<section class="bg-slate bumper-top-medium bumper-bottom-medium page-left page-right">
	<div class="row-fluid">
		<div class="span4">
			<div class=" center">
				<img class="img-polaroid" src="<?php echo THEME_IMAGES; ?>temp/banner.jpg">
				<h4>Only one in Cincinatti.</h4>
				<p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</p>
			
			</div>
			
		</div>
		<div class="span4">
		
			<div class="center">
				<img class="img-polaroid" src="<?php echo THEME_IMAGES; ?>temp/banner.jpg">
				<h4>5 star rating</h4>
				<p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
			</div>
			
		</div>
		<div class="span4">
		
			<div class=" center">
				<img class="img-polaroid" src="<?php echo THEME_IMAGES; ?>temp/banner.jpg">
				<h4>Heading</h4>
				<p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
			</div>
			
		</div>
	</div>
</section>	


<section class="bg-slate bumper-top-medium bumper-bottom-medium page-left page-right">
	<div class="row-middle">
		<div class="middle">
			<div class="bumper-right-large">
				<h2>Why does <strong class="green">McDonalds</strong> choose Clearview for their professional window cleaning?</h2>
				<p class="lead">
				WindowCleaning.com is a national network of the <strong>best window cleaners</strong> in each city. In most cities, <strong>only one window cleaner is chosen out of hundreds</strong> of window cleaners! Each window cleaner is interviewed personally by one of our team. We verify their level of experience, if they are properly insured, their reputation in the industry, and how their customers feel about the service they provide. Then we choose the best.
				</p>
			</div>
		</div>
		<div class="middle5">
			<div>
				<img class="img-polaroid" src="<?php echo THEME_IMAGES; ?>temp/banner.jpg">
				<div class="curved-shadow">
					<img src="<?php echo THEME_IMAGES; ?>backgrounds/bottom-shadow.png" />
				</div>
			</div>			
		</div>
		
	</div>		

	<div class="row-fluid">
		<div class="span12">
			
			<!-- Review Module -Using the inverted color style
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
<!--
<section class="bg-white bumper-top-medium">
	<div class="row-fluid">
		<div class="span12">
			
			<!-- Hero Module -  JumboTron style - Giant image with a headline text and citation
			===========================================================================================================
			--*>
			
			<div class="jumbotron hidden-phone" style="background: url('<?php echo THEME_IMAGES; ?>temp/ChicagoSkyline.jpg'); background-size: cover;">
				<p class="white">"Thanks Chicago, for 37 great years and over 12,000 happy customers."</p>
				<cite class="white">John Carey, Owner of Streak Free Clean</cite> 
			</div>
			
		</div>
	</div>
</section>-->


<section class="bg-slate">
	<div class="row-fluid">
		<div class="span7">
			
			<!-- Address Module - Company address and Google map
			=====================================================
			-->
			
			<div class="page-left bumper-top-medium bumper-bottom-large">
				<div class="pull-left bumper-right">
					<img class="img-polaroid" src="http://maps.google.com/maps/api/staticmap?center=North+Bethesda,5703+Luxemburg+Street%2C+Apt.100,MD,20852&amp;zoom=9&amp;size=270x210&amp;maptype=roadmap&amp;markers=color:blue%7Clabel:A%7CNorth+Bethesda,5703+Luxemburg+Street%2C+Apt.100,MD,20852&amp;sensor=false" itemprop="image">
				</div>
			
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
		<div class="span5">
		
			<!-- Service area Module - List of locations serviced
			=====================================================
			-->
			
			<div class="page-right bumper-top-medium">
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
	
	
		
	
	


<!-- Review Modal -->
<div class="modal fade hide" id="add-review">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>So, how did we do?</h3>
	</div>
	<div class="modal-body">
		<textarea class="input-block-level" placeholder="Your review" rows="3"></textarea>
	</div>
	<div class="modal-footer">
		<div class="pull-left">
			<p><small><input type="checkbox" name="" value="" checked="checked" /> <span>Share on Facebook</span></small></p>
		</div>
		<a href="javascript:void(0);" class="btn btn-success save">Send</a>
	</div>
</div>
<!-- / modal -->


<?php */
the_post();
the_content();
get_footer(); ?>
