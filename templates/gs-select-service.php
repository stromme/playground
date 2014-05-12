<div id="service-list">
  <?php
  $primary_service = get_option('primary_service');

  // Get a list of all the services including empty ones (Non promoted ones)
  $services = get_terms('services', array('hide_empty' => 0, 'orderby' => 'term_name', 'order' => 'ASC'));
  $even = false;
  foreach ($services as $service) {
    $primary = ($primary_service==$service->name);
    ?>
    <div class="tier <?=($even)?'even':''?>" data-name="<?=$service->name?>">
      <span class="input-lg pull-left"><?=$service->name?></span>
      <span class="rounded pull-right"><a href="" data-nonce="<?=wp_create_nonce('set-primary-service'.date('Ymd'))?>" class="btn btn-flat select-service <?=($primary)?'btn-blue':'btn-white'?>"><?=($primary)?'Primary':'Select <span class="glyphicon glyphicon-plus"></span>'?></a></span>
      <div class="clearfix"></div>
    </div>
    <?php
    $even = !$even;
  }
  // Custom services
  $tb_custom_services = get_option('tb_custom_services');
  $count_custom_services = (is_array($tb_custom_services))?count($tb_custom_services):0;
  if($count_custom_services>0) {
    foreach($tb_custom_services as $value) {
      $primary = ($primary_service==$value);
      ?>
      <div class="tier <?=($even)?'even':''?>" data-type="custom-services">
        <span class="input-lg pull-left"><?=$value?></span>
        <span class="rounded pull-right"><a href="" data-nonce="<?=wp_create_nonce('set-primary-service'.date('Ymd'))?>" class="btn btn-flat btn-white select-service <?=($primary)?'btn-blue':'btn-white'?>"><?=($primary)?'Primary':'Select <span class="glyphicon glyphicon-plus"></span>'?></a></span>
        <div class="clearfix"></div>
      </div>
      <?php
      $even = !$even;
    }
  }
  ?>
</div>