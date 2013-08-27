<?php
/**
 * Template Name: Home Transitional
 * Description: The Template for displaying home page that have been transitioned from the old toolbox.
 *
 *
 * @package WordPress
 * @subpackage Hatch
 * @since
 */

get_header();
$service_name = get_the_title();
$tb_company = get_option('tb_company');
$seo = get_location_seo();
?>

<!-- Wrap the page in .container to centre the content and keep it at a max width -->
<div class="container gentle-shadow">

  <!-- Banner -->
  <section class="bg-white">
  <?=apply_filters('cbtb_load_banner', true)?>
  </section>

  <!-- Awards accolades -->
  <?php
    $awards_accolades = apply_filters('cbtb_load_awards_accolade', true);
    if(isset($awards_accolades['count']) && $awards_accolades['count']>0){
  ?>
  <section class="bg-white bumper-top-small bumper-bottom-small page-left page-right">
    <?=$awards_accolades['display']?>
  </section>
  <?php } ?>

  <!-- Services list -->
  <?php
    $services_list = apply_filters('cbtb_load_services', true);
    if(isset($services_list['count']) && $services_list['count']>0){
  ?>
  <section class="bg-slate bumper-top-small bumper-bottom-medium">
    <?=$services_list['display']?>
  </section>
  <?php } ?>

  <!-- Headline and featurette -->
  <section class="bg-white bumper-top-medium bumper-bottom-medium page-left page-right">
    <div class="row-fluid">
      <div class="span5">
        <div>
          <div class="cfct-mod-content"><h2><strong  class="green">Don't take any chances.</strong><br/><br/>We're backed by North America's premier window cleaning network, fully insured and our work is 100% guaranteed.</h2></div>
        </div>
      </div>
      <div class="span7">
        <?=apply_filters('cbtb_load_home_featurette', true)?>
      </div>
    </div>
  </section>

  <!-- Featured review -->
  <section class="bg-white bumper-top-small page-left page-right">
    <?=apply_filters('cbtb_load_reviews', 1)?>
  </section>

  <!-- Featurette and pinned reviews -->
  <section class="bg-white bumper-top-medium bumper-bottom-medium page-left page-right">
    <?php $featurette_reviews = apply_filters('cbtb_load_featurette_reviews', true); ?>
    <?php if($featurette_reviews['count']>0){ ?>
    <div class="row-fluid">
      <div class="span7">
        <div class="has-right-sidebar migrate">
    <?php } else { echo '<div class="migrate">'; } ?>
          <div class="cfct-mod-content">
            <h2>Why <?=stripslashes(isset($tb_company['name'])?$tb_company['name']:'this company')?> was awarded <strong class="green">Best in <?=$seo['city']?>, <?=$seo['state']?>.</strong></h2>
            <?php
              the_post();
              the_content();
            ?>
          </div>
        </div>
    <?php if($featurette_reviews['count']>0){ ?>
      </div>
      <div class="span5">
        <?=$featurette_reviews['display']?>
      </div>
    </div>
    <?php } ?>
  </section>

  <!-- Award info - No changes -->
  <section class="bg-white bumper-top-medium bumper-bottom-small page-left page-right">
    <?=apply_filters('cbtb_load_award_info', true);?>
  </section>

  <!-- Certifications -->
  <?php
    $certifications_accolades = apply_filters('cbtb_load_certifications_accolade', true);
    if(isset($certifications_accolades['count']) && $certifications_accolades['count']>0){
  ?>
  <section class="bg-white bumper-top bumper-bottom-small page-left page-right">
  	<div class="center">
  		<h2>We're <strong class="green">proud members</strong> of the...</h2>
  	</div>
    <?=$certifications_accolades['display']?>
  </section>
  <?php } ?>

  <!-- Address and were we work -->
  <section class="bg-white bumper-top-medium bumper-bottom-medium page-left page-right">
    <div class="row-fluid">
      <div class="span8">
        <!-- Address Module - Company address and Google map -->
        <?=apply_filters('cbtb_load_address', true);?>
        <!-- / Address -->
      </div>
      <div class="span4">
        <div>
          <!-- Service area Module - List of locations serviced -->
          <?=apply_filters('cbtb_load_locations', true);?>
          <!-- / Service area -->
        </div>
      </div>
    </div>
  </section>

</div>
<?php get_footer(); ?>