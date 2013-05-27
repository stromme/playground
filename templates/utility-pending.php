<?php
/**
 * Description: Used to show a pending post.
 *
 *
 * @package WordPress
 * @subpackage Hatch
 * @since
 */

// Location SEO keywords
$seo = get_location_seo();

// Company name to include in titles
$company = get_option('tb_company');

?>

<!-- Wrap the page in .container to centre the content and keep it at a max width -->
<div class="container gentle-shadow">

  <!-- Banner -->
  <section class="bg-white center page-left page-right bumper-top-Xlarge bumper-bottom-Xlarge">
   	<h1 class="bumper-bottom-medium">Welcome aboard!</h1>
   	<h2 class="bumper-bottom-medium"><strong class='green'><?=$company['name']?></strong> has been approved as the exclusive WindowCleaning.com member in <?=$seo['city']?>.</h2>
   	<p>The new site will launch in the next few days, check back soon.</p>
  </section>

</div>