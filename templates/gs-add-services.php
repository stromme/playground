<div id="service-list">
  <?php
  // Get a list of all the services including empty ones (Non promoted ones)
  $services = get_terms('services', array('hide_empty' => 0, 'orderby' => 'term_name', 'order' => 'ASC'));
  $arr_terms = array();
  $arr_terms_obj = array();

  foreach ($services as $key=>$service) {
    array_push($arr_terms, $service->slug);
    $arr_terms_obj[$service->slug] = $service;
  }
  uasort($services, "compare_promote_order");

  $tb_industry = get_option('tb_industry');
  $count_suggestion = count($tb_industry['services']);
  $even = false;
  if ($count_suggestion>0) {
    foreach($tb_industry['services'] as $key => $value) {
      $text = 'Add <span class="glyphicon glyphicon-plus"></span>';
      $class = 'btn-white add-service';
      $attr = '';
      if(in_array($key, $arr_terms)){
        $text = '<span class="n">Added</span><span class="h">Remove</span>';
        $class = 'btn-blue delete-term';
        $attr = 'data-term-id="'.$arr_terms_obj[$key]->term_id.'"';
        unset($arr_terms_obj[$key]);
      }
      ?>
      <div class="tier <?=($even)?'even':''?>" data-type="services" <?=$attr?> data-id="<?=$key?>">
        <span class="input-lg pull-left"><?=$value?></span>
        <span class="rounded pull-right"><a href="" class="btn btn-flat <?=$class?>"><?=$text?></a></span>
        <div class="clearfix"></div>
      </div>
      <?php
      $even = !$even;
    }
  }

  // Custom services
  $tb_custom_services = get_option('tb_custom_services');
  $count_custom_services = (is_array($tb_custom_services))?count($tb_custom_services):0;
  if($count_custom_services>0) {
    foreach($tb_custom_services as $value) {
      ?>
      <div class="tier <?=($even)?'even':''?>" data-type="custom-services">
        <span class="input-lg pull-left"><?=$value?></span>
        <span class="rounded pull-right"><a href="javascript:void(0);" class="btn btn-flat btn-blue">Added</a></span>
        <div class="clearfix"></div>
      </div>
      <?php
      $even = !$even;
    }
  }
  ?>
  <div class="tier <?=($even)?'even':''?> list">
    <input type="text" id="input-term" placeholder="A different service" class="input-lg pull-left" />
    <span class="rounded pull-right"><a href="" class="btn btn-flat btn-white add-term" data-nonce="<?=wp_create_nonce('custom-service-'.date('Ymd'))?>">Add <span class="glyphicon glyphicon-plus"></span></a></span>
    <div class="clearfix"></div>
  </div>
</div>
<div id="template-service" class="tier template">
  <span class="input-lg pull-left service-name"></span>
  <span class="rounded pull-right"><a href="" class="btn btn-flat btn-blue">Added</a></span>
  <div class="clearfix"></div>
</div>