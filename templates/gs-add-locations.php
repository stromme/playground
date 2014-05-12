<div class="tier list">
  <span class="rounded pull-right"><a href="" class="btn btn-flat btn-white add-term">Add <span class="glyphicon glyphicon-plus"></span></a></span>
  <input type="text" id="input-city" placeholder="City / Town name" class="input-lg pull-left" />
  <?php
    $tb_company = get_option('tb_company');
    $company_state = $tb_company['state'];
  ?>
  <select id="input-state" validation="not-empty" data-field-name="<?=(($tb_company['country'] == 'CA')?'Province':'State')?>" class="input-large pull-left">
    <?php
    echo '<option value="">Select ' . (($tb_company['country'] == 'CA')?'Province':'State') . '...</option>';

    if ($tb_company['country'] == 'CA') {
      $state = tb_get_ca_provinces();
    } else {
      $state = tb_get_us_states();
    }
    foreach ($state as $key => $value) {
      if ($key == $company_state) $selected = 'selected';
      echo '<option ' . $selected . ' value="' . $key . '">' . $value . '</option>';
      $selected = '';
    }
    ?>
  </select>
  <div class="clearfix"></div>
</div>
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

  $even = true;
  foreach ($locations as $location) {
    ?>
      <div id="<?=$location->taxonomy?>-<?=$location->slug?>-<?=$location->term_id?>" data-type="<?=$location->taxonomy?>" data-term-id="<?=$location->term_id?>" class="tier <?=($even)?'even':''?>">
        <span class="input-lg pull-left"><?php echo $location->name; ?></span>
        <span class="rounded pull-right"><a href="" class="btn btn-flat btn-blue delete-term"><span class="n">Added</span><span class="h">Remove</span></a></span>
        <div class="clearfix"></div>
      </div>
    <?php
    $even = ($even)?false:true;
  }
  ?>
</div>
<div id="template-city" class="tier template">
  <span class="input-lg pull-left city-name"></span>
  <span class="rounded pull-right"><a href="" class="btn btn-flat btn-blue delete-term"><span class="n">Added</span><span class="h">Remove</span></a></span>
  <div class="clearfix"></div>
</div>