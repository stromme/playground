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

<ul class="link-grid clearfix">
  <?php
    foreach($services as $service){
      $args = array('post_type' => 'research', 'taxonomy' => 'services', 'term' => $service->slug);
      $is_service_promoted = TB_Promote::is_promoted($args);
      if($is_service_promoted){
  ?>
  <li>
    <div class="grid-thumb">
      <nav>
        <a href="<?=get_home_url().$blog_prefix."/services/".$service->slug?>"><i class="icon-picture icon-white"></i> Showroom</a>
        <a href=""><i class="icon-info-sign icon-white"></i> Learn more</a>
      </nav>
      <img src="http://localhost/wpmulti/wp-content/themes/playground/images/temp/category.png" alt="">
    </div>
    <a href="<?=get_home_url().$blog_prefix."/services/".$service->slug?>"><?=$service->name?></a>
  </li>
  <?php
      }
    }
  ?>
</ul>