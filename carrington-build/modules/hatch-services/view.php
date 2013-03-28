<?php
/**
 * Description: Services Module - default view.
 * A module to display list of services.
 *
 * @package
 * @subpackage
 * @since
 */

  $blog_prefix = '';
  if ( is_multisite() && !is_subdomain_install() && is_main_site() )
    $blog_prefix = '/blog';
?>
<div class="bumper-bottom">
  <h2 class="blue center">What we're <strong class="green">really</strong> good at.</h2>
</div>
<ul class="link-grid clearfix">
  <?php
    foreach($services as $service){
      $args = array('post_type' => 'research', 'taxonomy' => 'services', 'term' => $service->slug);
      $is_service_promoted = TB_Promote::is_promoted($args);
      $args = array(
        'post_type'   => 'showroom',
        'services'    => $service->slug,
        'order'       => 'ASC',
        'numberposts' => 1
      );
      $service_post_query = new WP_Query( $args );
      $is_have_post = $service_post_query->have_posts();
  ?>
  <li>
    <div class="grid-thumb">
      <?php if($is_have_post || $is_service_promoted){ ?>
      <nav>
        <?php if($is_have_post){ ?>
        <a href="<?=get_home_url()."/showroom/".$service->slug?>"><i class="icon-picture icon-white"></i> Showroom</a>
        <?php } if($is_service_promoted){ ?>
        <a href="<?=get_home_url().$blog_prefix."/services/".$service->slug?>"><i class="icon-info-sign icon-white"></i> Learn more</a>
        <?php } ?>
      </nav>
      <?php } ?>
      <img src="<?=get_home_url()?>/wp-content/themes/playground/images/temp/category.png" alt="" />
    </div>
    <?php if($is_service_promoted){ ?>
    <a href="<?=get_home_url().$blog_prefix."/services/".$service->slug?>"><?=$service->name?></a>
    <?php } else { ?>
    <span><?=$service->name?></span>
    <?php } ?>
  </li>
  <?php
    }
  ?>
</ul>