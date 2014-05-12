<div id="city-list">
  <?php
  // Get a list of all the services including empty ones (Non promoted ones)
  $locations = get_terms('locations', array('hide_empty' => 0, 'orderby' => 'term_name', 'order' => 'ASC'));
  $arr_terms = array();

  $i=0;
  foreach ($locations as $key=>$location) {
    $desc = json_decode($location->description);
    $locations[$key]->order = ($desc && isset($desc->order))?($desc->order):$i;
    ++$i;
    array_push($arr_terms, $location->slug);
  }
  uasort($locations, "compare_promote_order");

  $primary_city = intval(get_option('primary_city'));
  $even = true;
  foreach ($locations as $location) {
    $primary = ($primary_city==$location->term_id);
    ?>
      <div id="<?=$location->taxonomy?>-<?=$location->slug?>-<?=$location->term_id?>" data-slug="<?=$location->slug?>" data-term-id="<?=$location->term_id?>" class="tier <?=($even)?'even':''?>">
        <span class="input-lg pull-left"><?php echo $location->name; ?></span>
        <span class="rounded pull-right"><a href="" data-nonce="<?=wp_create_nonce('set-primary-city'.date('Ymd'))?>" class="btn btn-flat select-city <?=($primary)?'btn-blue':'btn-white'?>"><?=($primary)?'Primary':'Select <span class="glyphicon glyphicon-plus"></span>'?></a></span>
        <div class="clearfix"></div>
      </div>
    <?php
    $even = ($even)?false:true;
  }
  ?>
</div>