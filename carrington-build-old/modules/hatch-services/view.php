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
        $args = array('post_type' => 'cftl-tax-landing', 'taxonomy' => 'services', 'term' => $service->slug, 'post_status' => 'publish');
        $is_service_promoted = TB_Promote::is_promoted($args);
        $args = array(
          'post_type'   => 'showroom',
          'services'    => $service->slug,
          'order'       => 'ASC',
          'numberposts' => 1
        );
        $service_post_query = new WP_Query( $args );
        $is_have_post = $service_post_query->have_posts();
        unset($service_post_query);
  ?>
  <li itemprop="makesOffer" itemscope="http://schema.org/Offer">
    <div class="grid-thumb">
      <?php if(($is_have_post || $is_service_promoted) && !$no_image){ ?>
      <nav>
        <?php if($is_have_post){ ?>
        <a href="<?=get_home_url()."/showroom/".$service->slug?>/"><i class="icon-picture icon-white"></i> Showroom</a>
        <?php } if($is_service_promoted){ ?>
        <a href="<?=get_home_url()."/services/".$service->slug?>/"><i class="icon-info-sign icon-white" itemprop="url"></i> Learn more</a>
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
        if($no_image){
          $service_image = '<img src="'.TOOLBOX_IMAGES.'/spacer.gif" style="width:240px;height:1px;min-height:1px;" />';
        }
      ?>
      <?=$service_image?>
    </div>
    <?php if($is_service_promoted){ ?>
    <div class="center">
    <a href="<?=get_home_url()."/services/".$service->slug?>" itemprop="name"><?=$service->name?></a>
    </div>
    <?php } else { ?>
    <div class="center">
    <span itemprop="name"><?=$service->name?></span>
    </div>
    <?php } ?>
  </li>
  <?php
      }
    }
  ?>
</ul>
<?php
  unset($services);
?>