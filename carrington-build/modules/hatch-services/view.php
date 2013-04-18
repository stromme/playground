<?php
/**
 * Description: Services Module - default view.
 * A module to display list of services.
 *
 * @package
 * @subpackage
 * @since
 */
?>
<div class="bumper-bottom">
  <h2 class="center"><?=parse_shortclass($title)?></h2>
</div>
<ul class="link-grid clearfix">
  <?php

    if(class_exists('TB_Promote')){
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
  <li itemprop="makesOffer" itemscope="http://schema.org/Offer">
    <div class="grid-thumb">
      <?php if($is_have_post || $is_service_promoted){ ?>
      <nav>
        <?php if($is_have_post){ ?>
        <a href="<?=get_home_url()."/showroom/".$service->slug?>"><i class="icon-picture icon-white"></i> Showroom</a>
        <?php } if($is_service_promoted){ ?>
        <a href="<?=get_home_url().get_blog_prefix()."services/".$service->slug?>"><i class="icon-info-sign icon-white" itemprop="url"></i> Learn more</a>
        <?php } ?>
      </nav>
      <?php } ?>
      <?php
        $service_image = TOOLBOX_BASE_DIR.'/images/services/'.$service->slug.'.jpg';
        if(file_exists($service_image)){
          $service_image = '<img src="'.TOOLBOX_IMAGES.'/services/'.$service->slug.'.jpg" itemprop="image"/>';
        } else {
          $service_image = '<img src="'.TOOLBOX_IMAGES.'/spacer.gif" style="width:240px;height:80px;background-color:#F6F6F6;" />';
        }
      ?>
      <?=$service_image?>
    </div>
    <?php if($is_service_promoted){ ?>
    <a href="<?=get_home_url().get_blog_prefix()."services/".$service->slug?>" itemprop="name"><?=$service->name?></a>
    <?php } else { ?>
    <span itemprop="name"><?=$service->name?></span>
    <?php } ?>
  </li>
  <?php
      }
    }
  ?>
</ul>