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

<!-- Header
==================================================
-->
<header class="container">
	<nav>
		<ul class="headline">
			<li class="headline-title">
				<h1>Awarded 2013 <b>Best Window Cleaners</b> in <a href="" class="link-inverse link-decorate link-showoff" data-toggle="tooltip" data-placement="bottom" title="Visit another location">Seattle</a></h1>
			</li>
			<li class="headline-phone">
				<h4><a href="">(898) 123-1234</a></h4>
			</li>
			<li class="headline-link  hidden-phone hidden-tablet">
				<h4><a href="">Quick Estimate</a></h4>
			</li>
		</ul>
		<ul class="main-nav nav nav-pills">
			<li class="dropdown hidden-desktop"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Learn More <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="#">Home Window Cleaning</a></li>
					<li><a href="#">Commercial Window Cleaning</a></li>
					<li><a href="#">Power Washing</a></li>
					<li><a href="#">Seattle</a></li>
					<li><a href="#">Tacoma</a></li>
					<li><a href="#">Portland</a></li>
				</ul>
			</li>
			<li class="dropdown visible-desktop"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Locations <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="#">Seattle</a></li>
					<li><a href="#">Tacoma</a></li>
					<li><a href="#">Portland</a></li>
				</ul>
			</li>
			<li class="dropdown visible-desktop"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Services <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="#">Home Window Cleaning</a></li>
					<li><a href="#">Commercial Window Cleaning</a></li>
					<li><a href="#">Power Washing</a></li>
				</ul>
			</li>
			<li class=" visible-desktop"><a href="#">Showroom</a></li>
			<li class="nav-callout nav-callout-border"><a href="#" class="clear-pills">Reviews</a><b class="nav-callout-border-notch notch"></b><b class="notch"></b></li>
			<li class="nav-callout nav-callout-border hidden-desktop"><a href="#" class="clear-pills">Quick Estimate</a><b class="nav-callout-border-notch notch"></b><b class="notch"></b></li>
		</ul>
	</nav>
	<div class="brand">
		<img src="<?php echo THEME_IMAGES; ?>temp/window-cleaning-dot-com-logo.png">
	</div>
</header>

<!-- Wrap the page in .container to centre the content and keep it at a max width -->
<div class="container gentle-shadow">

	<!-- Banner - A module to display a carousel of images and reviews
	==================================================
	-->
	<section class="banner no-bleed">
		<div class="banner-photo">
			<img src="<?php echo THEME_IMAGES; ?>temp/banner.jpg">	
		</div>
		<div class="banner-review">
			<blockquote>
				<p>"Couldn't be happier. They showed up on time and did a fantastic job. We'll call again for sure."</p>
				<p class="banner-customer"><cite class="grayDark">Rene C</cite>, Bethseda</p>
			</blockquote>
			<div class="fixed-bottom">
				<ul class="share-it">
					<li class="write-review"><a href=""><i class="icon-full-conversation"></i> Write your review</a></li>
					<!--<li class="social-network"><div class="fb-like" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false" data-font="verdana" data-action="like"></div></li>
					<li class="social-network"><a href="https://twitter.com/share" class="twitter-share-button" data-via="streakfreeclean" data-related="streakfreeclean" data-hashtags="WindowCleaning">Tweet</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></li>-->
				</ul>
			</div>
		</div>
	</section>
	<div class="curved-shadow">
		<img src="<?php echo THEME_IMAGES; ?>backgrounds/bottom-shadow.png" />
	</div>
	<!-- / Banner -->
	
		
	<!-- Show Off
	=============
	
	A full width headline module with or without a photo
	
	-->
	<section class="showoff">
		<h2 class="light-weight blue"><img src="<?php echo THEME_IMAGES; ?>temp/angies.png"> 2012 Angie's list superior service award winner.</h2>
	</section>
	<!--<section class="showoff">
		<h2 class="light-weight blue">What we're <span class="green">really</span> good at.</h2>
	</section>-->
	<!-- / Showoff -->
	
	<section class="bg-slate">
		<div class="row-fluid">
			<div class="span12">
				
				<!-- Link Grid
				==============
				
				A grid of links. Each link can have a thumbnail or description.
				
				-->
				<ul class="link-grid">
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
				<!--/ Link Grid -->
			</div>
		</div>
	</section>
	
	<section>
		<div class="row-fluid">
			<div class="span5">
				<h2 class="light-weight title">Don't take any chances, we are fully insured and our work is 100% guaranteed.</h2>
			</div>
			
			<div class="span7">
			
				<!-- Rich List
				==============
				
				A UL or OL with images instead of bullets
				
				-->
				<ul class="rich-list no-title no-footer">
				
					<li  class="image-bullet" style="background: url('<?php echo THEME_IMAGES; ?>temp/window-cleaning-guarantee-small.png') no-repeat;">
						<h4 class="green">Hassle free money back guarantee.</h4>
						<p>We’re proud to offer Bethesda's only $1000 Streak Free Guarantee. If you don’t love our work, we’ll refund up to $1000.</p>
					</li><!-- /image-bullet -->
					
					<li  class="image-bullet" style="background: url('<?php echo THEME_IMAGES; ?>temp/insured-window-cleaning.png') no-repeat;">
						<h4 class="green">We carry $1,000,000 in liability insurance.</h4>
						<p>Protect your home and family. Only work with fully insured WindowCleaning.com professionals.</p>
					</li><!-- /image-bullet -->
					
				</ul><!-- /rich-list -->
			</div>
		</div>		
	</section>
	
	<section class="bg-sky">
	
		<!-- Featurettes
		================
		
		Featured photos with a title and a description. Degrade peacefully to block elements on small screen sizes.
		
		-->
		<hr class="featurette-divider">
		
		<div class="featurette">
			<img class="featurette-image pull-right img-polaroid" src="<?php echo THEME_IMAGES; ?>temp/banner.jpg">
			<h2 class="featurette-heading">First featurette headling. <span class="muted">It'll blow your mind.</span></h2>
			<p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
		</div>
		<hr class="featurette-divider">
		<!--/ Featurette -->
		
	</section>
		
	<section class="bg-sky">
		
		<article>
			<div class="row-fluid">
				<aside class="offset1 span5">
					<div class="polaroid no-title">
						<img src="<?php echo THEME_IMAGES; ?>temp/banner.jpg">
					</div>
				</aside>
				
				<div class="span5">
					<h2 class="light-weight blue title">Why Squeaky Clean was awarded best in Los Angeles, CA.</h2>
					<p>Yes, Squeeky Clean Window Washing has undergone a rigorous screening process. They have received our top ranking as the best window cleaners in Bethesda Maryland. We are so confident you will be completely satisfied with their window cleaning services that we offer our $1000 Streak Free Guarantee, only through WindowCleaning.com.</p>
				</div>
			</div>
		</article>
		
		<div class="row">
			<div class="offset1 span5 no-footer">
				<h2 class="light-weight blue title">We only use the best German engineered tools.</h2>
				<p>Yes, Squeeky Clean Window Washing has undergone a rigorous screening process. They have received our top ranking as the best window cleaners in Bethesda Maryland. We are so confident you will be completely satisfied with their window cleaning services that we offer our $1000 Streak Free Guarantee, only through WindowCleaning.com.</p>
			</div>
			<div class="span5 no-title no-footer">
				<div class="polaroid">
					<img src="<?php echo THEME_IMAGES; ?>temp/banner.jpg">
				</div>
			</div>
		</div>
		
		
		<!--
		<div class="row">
			<div class="offset1 span10 bg-deep-blue inset inset-fixed-bottom inset-review">
				<!--<h2 class="white light-weight">Loved in Cincinatti...</h2>--*>
				<blockquote>
					<h3 class="white light-weight" >"We are very pleased with the quality of work as well as the professional and courteous service. Squeeky Clean gets my endorsement and business."</h3>
					<p class="white"><cite>~George Michael</cite><span class="light-weight">, Cincinatti</span></p>
				</blockquote>
			</div>
		</div>-->
		<!--
		<div class="row">
			<div class="offset1 span10 bg-deep-blue inset-content">
				<div class="row">
					<div class="span4">
						<h2 class="white" style="font-weight:200;">Loved in Cincinatti...</h2>
					</div>
					<div class="span4">
					</div>
				</div>
				<p class="white">
					WindowCleaning.com is a national network of the best window cleaners in each city. In most cities, only one window cleaner is chosen out of hundreds of window cleaners! Each window cleaner is interviewed personally by one of our team. We verify their level of experience, if they are properly insured, their reputation in the industry, and how their customers feel about the service they provide. Then we choose the best.
					
					You can be sure, that by choosing a WindowCleaning.com awarded member, you are choosing the best. And to back it up, all WindowCleaning.com members offer our no hassle $1000 Streak Free Guarantee!
				</p>
			</div>
		</div>-->
	</section>
	
	<section class="bg-deep-blue">
		<div class="center">
			<h2 class="white light-weight sub-title">Loved in your neighbourhood.</h2>
		</div>
		<div class="row-fluid">
			<div class="offset1 span5">
				<div class="no-footer">
					<div class="pen-stroke-blue"></div>
					<div class="media">
						<div class="pull-left" href="#">
							<img class="media-object img-circle gravatar gravatar-inverse" src="<?php echo THEME_IMAGES; ?>temp/banner.jpg">
						</div>
						<blockquote class="media-body review review-inverse">
							<h4>"We are very pleased with the quality of work as well as the professional and courteous service. Squeeky Clean gets my endorsement and business."</h4>
							<p><cite>~George Michael</cite><span>, Cincinatti</span></p>
						</blockquote>
					</div>
					<div class="pen-stroke-blue"></div>
					<div class="media">
						<div class="pull-left" href="#">
							<img class="media-object img-circle gravatar" src="<?php echo THEME_IMAGES; ?>temp/banner.jpg">
						</div>
						<blockquote class="media-body review review-inverse">
							<h4>"We are very pleased with the quality of work as well as the professional and courteous service. Squeeky Clean gets my endorsement and business."</h4>
							<p><cite>~George Michael</cite><span>, Cincinatti</span></p>
						</blockquote>
					</div>
					<div class="pen-stroke-blue"></div>
					<div class="media">
						<div class="pull-left" href="#">
							<img class="media-object img-circle gravatar" src="<?php echo THEME_IMAGES; ?>temp/banner.jpg">
						</div>
						<blockquote class="media-body review review-inverse">
							<h4>"We are very pleased with the quality of work as well as the professional and courteous service. Squeeky Clean gets my endorsement and business."</h4>
							<p><cite>~George Michael</cite><span>, Cincinatti</span></p>
						</blockquote>
					</div>
				</div>
			</div><!-- / span5 -->
			
		</div>
	</section>
	<section class="">
		<img src="<?php echo THEME_IMAGES; ?>backgrounds/bottom-shadow.png" style="width: 100%;"alt="" />
	</section>
	
	<section class="bg-slate">
		<div class="row-fluid towers">
			<div class="span4">
				<img class="img-circle" data-src="holder.js/140x140">
				<h2>Only one in Cincinatti.</h2>
				<p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</p>
				<p><a class="btn" href="#">View details &raquo;</a></p>
			</div><!-- /.span4 -->
			<div class="span4">
				<img class="img-circle" data-src="holder.js/140x140">
				<h2>5 star rating</h2>
				<p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
				<p><a class="btn" href="#">View details &raquo;</a></p>
			</div><!-- /.span4 -->
			<div class="span4">
				<img class="img-circle" data-src="holder.js/140x140">
				<h2>Heading</h2>
				<p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
				<p><a class="btn" href="#">View details &raquo;</a></p>
			</div><!-- /.span4 -->
		</div><!-- /.row -->
	</section>
	
	<section>
		<div class="row-fluid">
		
			<div class="offset1 span4">
				<h2 class="light-weight title">Don't take any chances, we are fully insured and our work is 100% guaranteed.</h2>
			</div>
			
			<div class="span6">
				<ul class="rich-list no-title no-footer">
				
					<li  class="image-bullet" style="background: url('<?php echo THEME_IMAGES; ?>temp/window-cleaning-guarantee-small.png') no-repeat;">
						<h4 class="green">Hassle free money back guarantee.</h4>
						<p>We’re proud to offer Bethesda's only $1000 Streak Free Guarantee. If you don’t love our work, we’ll refund up to $1000.</p>
					</li><!-- /image-bullet -->
					
					<li  class="image-bullet" style="background: url('<?php echo THEME_IMAGES; ?>temp/insured-window-cleaning.png') no-repeat;">
						<h4 class="green">We carry $1,000,000 in liability insurance.</h4>
						<p>Protect your home and family. Only work with fully insured WindowCleaning.com professionals.</p>
					</li><!-- /image-bullet -->
					
				</ul><!-- /rich-list -->
			</div>
			
		</div>		
	</section>
	
	
	<section>
		<div class="row">
			<div class="span12">
				<div class="location-banner-full-width" style="background: url('<?php echo THEME_IMAGES; ?>temp/ChicagoSkyline.jpg'); background-size: cover;">
					<h2 class="white">"Thanks Chicago, for 37 great years and over 12,000 happy customers."</h2>
					<h4 class="white"><em>John Carey, Owner of Streak Free Clean</em></h4> 
				</div>
				<div>
					<img src="<?php echo THEME_IMAGES; ?>backgrounds/bottom-shadow.png" style="width: 100%;"alt="" />
				</div>
			</div>
		</div>
	</section>
	
	
	<section>
		<div class="row-fluid">
			<div class="offset1 span6 no-title">
				
				<div class="polaroid pull-left bumper-right">
					<!--<img src="http://maps.google.com/maps/api/staticmap?center=North+Bethesda,5703+Luxemburg+Street%2C+Apt.100,MD,20852&amp;zoom=9&amp;size=270x210&amp;maptype=roadmap&amp;markers=color:blue%7Clabel:A%7CNorth+Bethesda,5703+Luxemburg+Street%2C+Apt.100,MD,20852&amp;sensor=false" itemprop="image">-->
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
			<div class="span4 no-title">
				<h3 class="light-weight">Were we work</h3>
				<ul>
					<li>Cincinatti</li>
				</ul>
			</div>
		</div>
	</section>
	
	<section>
		<div class="row">
			<div class="offset1 span10">
				<div class="location-banner" style="background: url('<?php echo THEME_IMAGES; ?>temp/ChicagoSkyline.jpg'); background-size: cover;">
					<!--<img src="<?php echo THEME_IMAGES; ?>temp/ChicagoSkyline.jpg" style="width:100%; height: 400px;" alt="" />-->
					<h2 class="white">"Thanks Chicago, for 37 great years and over 12,000 happy customers."</h2>
					<h4 class="white"><em>John Carey, Owner of Streak Free Clean</em></h4> 
				</div>
				<div>
					<img src="<?php echo THEME_IMAGES; ?>backgrounds/bottom-shadow.png" style="width: 100%;"alt="" />
				</div> 
			</div>
		</div>
	</section>
	
	
	
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
	</section>
	
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
	
	
	<div class="row-fluid towers">
		<div class="span4">
			<img class="img-circle" data-src="holder.js/140x140">
			<h2>Heading</h2>
			<p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</p>
			<p><a class="btn" href="#">View details &raquo;</a></p>
		</div><!-- /.span4 -->
		<div class="span4">
			<img class="img-circle" data-src="holder.js/140x140">
			<h2>Heading</h2>
			<p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
			<p><a class="btn" href="#">View details &raquo;</a></p>
		</div><!-- /.span4 -->
		<div class="span4">
			<img class="img-circle" data-src="holder.js/140x140">
			<h2>Heading</h2>
			<p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
			<p><a class="btn" href="#">View details &raquo;</a></p>
		</div><!-- /.span4 -->
	</div><!-- /.row -->
	
	
	<section class="bg-deep-blue footer">
		<h4 class="white light-weight"><img style="max-width:20px;"src="<?php echo THEME_IMAGES; ?>temp/window-cleaning-award.png"> Awarded 2013 Best Window Cleaners in Seattle.</h4>
		<nav>
			<ul>
				<li><a href="#">Showroom</a></li>
				<li><a href="#">Reviews</a></li>
				<li><a href="#">Services</a></li>
				<li><a href="#">Locations</a></li>
			</ul>
		</nav>	
	</section>
	
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	
	
	
</div><!-- / .container -->


<section class="">
	<div class="row">
		<div class="span4" style="background-color:#000000; height: 50px;">
		</div>
		<div class="span4" style="background-color:#000000; height: 50px;">
		</div>
		<div class="span4" style="background-color:#000000; height: 50px;">
		</div>
		
		
	</div>
</section>

<?php get_footer(); ?>
