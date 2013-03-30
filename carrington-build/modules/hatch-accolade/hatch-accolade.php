<?php

if (!class_exists('cfct_module_hatch_accolade') && class_exists('cfct_build_module')) {
	class cfct_module_hatch_accolade extends cfct_build_module {
    private $accolades = array(
      'awards' => array('name' => 'Awards', 'content' => array()),
      'news' => array('name' => 'News', 'content' => array()),
      'certifications' => array('name' => 'Certifications', 'content' => array()),
      'insurances' => array('name' => 'Insurances', 'content' => array())
    );
    private $styles = array(
      'header' => 'Header',
      'featurette' => 'Featurette'
    );
    private $selected = array();

		public function __construct() {
			$opts = array(
				'description' => __('Display a headline, (optional) image and brief text with a link.', 'carrington-build'),
				'icon' => 'hatch-accolade/icon.png'
			);
			parent::__construct('cfct-module-hatch-accolade', __('.: Hatch Accolade :.', 'carrington-build'), $opts);

      $args = array(
        'post_type' => array('accolades'),
        'numberposts' => -1,
        'post_status' => 'published',
        'post_parent' => 0,
        'orderby'        => 'post_date',
        'order'          => 'DESC'
      );
      // Do get it
      $accolades_post = get_posts($args);
      if($accolades_post && count($accolades_post)>0){
        foreach($accolades_post as $ac){;
          $terms = wp_get_post_terms($ac->ID, 'accolade-types');
          if((gettype($terms)=='object' && get_class($terms)!='WP_Error') && $terms && count($terms)>0){
            if(count($terms)>1){
              foreach($terms as $term){
                if(isset($this->accolades[$term->slug])){
                  $args = array(
                    'post_type' => 'attachment',
                    'numberposts' => 1,
                    'post_status' => 'any',
                    'post_parent' => $ac->ID
                  );
                  $attachments = get_posts($args);
                  $accolade_image = get_post_meta($ac->ID, 'accolade-logo', true);
                  $desc = get_post_meta($ac->ID, 'description', true);
                  if($attachments) {
                    $attachment = $attachments[0];
                    $image = wp_get_attachment_image_src($attachment->ID, 'full');
                    $accolade_image = $image[0];
                  }
                  array_push($this->accolades[$term->slug]['content'], array(
                    'id' => $ac->ID,
                    'title' => $ac->post_title,
                    'link' => $ac->post_content,
                    'description' => $desc,
                    'image' => $accolade_image
                  ));
                }
              }
            }
            else {
              $args = array(
                'post_type' => 'attachment',
                'numberposts' => 1,
                'post_status' => 'any',
                'post_parent' => $ac->ID
              );
              $attachments = get_posts($args);
              $accolade_image = get_post_meta($ac->ID, 'accolade-logo', true);
              $desc = get_post_meta($ac->ID, 'description', true);
              if($attachments) {
                $attachment = $attachments[0];
                $image = wp_get_attachment_image_src($attachment->ID, 'full');
                $accolade_image = $image[0];
              }
              array_push($this->accolades[$terms[0]->slug]['content'], array(
                'id' => $ac->ID,
                'title' => $ac->post_title,
                'link' => $ac->post_content,
                'description' => $desc,
                'image' => $accolade_image
              ));
            }
          }
        }
      }
		}

// Display
		public function display($data) {
      $id = 'accolade-'.$data['module_id'];
      $type = isset($data[$this->get_field_id('type')]) ? $data[$this->get_field_id('type')] : '';
      $accolade_id = isset($data[$this->get_field_id('accolade_id')]) ? $data[$this->get_field_id('accolade_id')] : '';
      $chosen_accolade = array();
      if(isset($accolade_id[$type]) && count($accolade_id[$type])>0 && count($this->accolades[$type]['content'])>0){
        foreach($this->accolades[$type]['content'] as $ac){
          if(in_array($ac['id'], $accolade_id[$type])){
            array_push($chosen_accolade, $ac);
          }
        }
      }
      $interval = isset($data[$this->get_field_id('interval')]) ? intval($data[$this->get_field_id('interval')]) : 4000;
      $style = (!empty($data[$this->get_field_name('style')]) ? esc_html($data[$this->get_field_name('style')]) : '');
      if($style=='') $style = 'header';

      $js_id = '';
      $js_init = '';
      if($style=="header"){
        $js_id = 'data_'.str_replace('-','_',$id);
        $js_init = '
        <script type="text/javascript">
          var '.$js_id.' = '.json_encode($chosen_accolade).';
          $(document).ready(function(){
            var carousel = $(".carousel-'.$id.'");
            carousel.carousel({
              interval: '.$interval.'
            });
            carousel.bind("slide", function(){
              $(this).animate({"opacity":0}, "fast", function(){
                $(this).animate({"opacity":1}, "slow");
              });
            });
          });
        </script>';
      }
      $this->view = 'view-'.$style.'.php';
			return $this->load_view($data, compact('id', 'type', 'chosen_accolade', 'interval', 'js_id', 'js_init'));
		}

		public function admin_form($data) {
			// basic info
      $type = (!empty($data[$this->get_field_name('type')]) ? esc_html($data[$this->get_field_name('type')]) : '');
      $accolade_id = isset($data[$this->get_field_name('accolade_id')]) ? $data[$this->get_field_name('accolade_id')] : '';
      $this->selected = $accolade_id;

      $style = (!empty($data[$this->get_field_name('style')]) ? esc_html($data[$this->get_field_name('style')]) : '');
      if($style=='') $style = 'header';
      $style_options = '';
      foreach($this->styles as $key=>$view_style){
        $style_options .= '<option value="'.$key.'"'.(($key==$style)?' selected=""':'').'>'.$view_style.'</option>';
      }

      $accolade_type_keys = array();
      foreach($this->accolades as $key=>$act){
        array_push($accolade_type_keys, $key);
      }
      if($type=='' || !in_array($type, $accolade_type_keys, true)){
        $type = 'awards';
      }
      $type_options = '';
      foreach($this->accolades as $key=>$accolade){
        $type_options .= '<option value="'.$key.'"'.(($key==$type)?' selected=""':'').'>'.$accolade['name'].'</option>';
      }
      $acollade_selection = $this->accolades[$type]['content'];
      $accolade_id_options = '';
      foreach($acollade_selection as $accolade){
        $accolade_id_options .= '<option value="'.$accolade->ID.'"'.(($accolade->ID==$accolade_id)?' selected=""':'').'>'.$accolade->post_title.'</option>';
      }

			$html = '
				<div id="'.$this->id_base.'-content-info">
					<div id="'.$this->id_base.'-content-fields">
						<div class="cfct-field">
							<label for="'.$this->get_field_id('type').'">'.__('Accolade type').'</label>
							<select name="'.$this->get_field_name('type').'" id="'.$this->get_field_id('type').'">'.$type_options.'</select>
						</div>
						<div class="cfct-field">
              <label for="'.$this->get_field_id('style').'">Layout style</label>
              <select id="'.$this->get_field_id('style').'" name="'.$this->get_field_name('style').'" class="cfct-style-chooser">'.$style_options.'</select>
            </div>
            <div class="cfct-field no-space">
              <label>Select accolades</label>
            </div>';
            foreach($this->accolades as $key=>$current_accolade){
            $select_all = (!empty($data[$this->get_field_name('select_all_'.$key)]) ? esc_html($data[$this->get_field_name('select_all_'.$key)]) : '');
            $html .= '
            <div class="cfct-accolade-container accolade-'.$key.'" style="'.(($key==$type)?'display:block;':'display:none;').'">
              <div class="cfct-field no-space">
                <input type="checkbox" value="1" class="cfct-check-all" id="'.$this->get_field_id('select_all_'.$key).'" name="'.$this->get_field_name('select_all_'.$key).'" '.(($select_all==1)?'checked="checked"':'').'/> <label for="'.$this->get_field_id('select_all_'.$key).'">Select all '.strtolower($this->accolades[$key]['name']).'</span> accolades</label>
              </div>
              <div class="cfct-field">
                <ul class="cfct-accolade-list">';
                foreach($this->accolades[$key]['content'] as $accolade){
                $selected = false;
                if(isset($accolade_id[$key]) && count($accolade_id[$key]>0)){
                  $selected = in_array($accolade['id'], $accolade_id[$key]);
                }
                $html .= '
                  <li'.(($selected)?' class="selected"':'').'>
                    <div class="cfct-accolade-checkbox"><input type="checkbox" value="'.$accolade['id'].'" id="'.$this->get_field_id('accolade_id').'_'.$key.'_'.$accolade['id'].'" name="'.$this->get_field_id('accolade_id').'['.$key.'][]" '.(($selected)?'checked="checked"':'').'/></div>
                    <div class="cfct-accolade-thumb">'.(($accolade['image']!='')?'<img src="'.$accolade['image'].'" />':'').'</div>
                    <label for="'.$this->get_field_id('accolade_id').'_'.$key.'_'.$accolade['id'].'" class="cfct-accolade-detail">
                      <div class="cfct-accolade-title">'.$accolade['title'].'</div>
                      <div class="cfct-accolade-description">'.$accolade['description'].'</div>
                    </label>
                  </li>';
                }
                $html .= '
                </ul>
              </div>
            </div>';
            }
					$html .= '
            <div id="'.$this->get_field_id('interval').'_selector" class="cfct-field"'.(($style=='featurette')?' style="display:none;"':'').'>
              <label for="'.$this->get_field_id('interval').'">'.__('Carrousel interval').'</label>
              <input type="text" name="'.$this->get_field_name('interval').'" id="'.$this->get_field_id('interval').'" value="'.(!empty($data[$this->get_field_name('interval')]) ? esc_html($data[$this->get_field_name('interval')]) : '4000').'" class="width-small" />
            </div>
          </div>
				</div>
				<div class="clear" />
				';

			return $html;
		}

		/**
		 * Return a textual representation of this module.
		 *
		 * @param array $data 
		 * @return string
		 */
		public function text($data) {
      $style = isset($data[$this->get_field_id('style')]) ? $data[$this->get_field_id('style')] : '';
      if($style=='') $style = 'header';
      $type = isset($data[$this->get_field_id('type')]) ? $data[$this->get_field_id('type')] : '';
      if($type=='') $type = 'awards';
			return $this->styles[$style]." ".strtolower($this->accolades[$type]['name']);
		}

		/**
		 * Modify the data before it is saved, or not
		 *
		 * @param array $new_data 
		 * @param array $old_data 
		 * @return array
		 */
		public function update($new_data, $old_data) {
			return $new_data;
		}
		
		public function admin_js() {
			$js = preg_replace('/^(\t){4}/m', '', '
        cfct_builder.addModuleLoadCallback("'.$this->id_base.'", function() {
          var container = $("#'.$this->id_base.'-content-fields");
          var check_all = $(".cfct-check-all", container);
          var ul;
          var li;
          $("label", container).mousedown(function(){return false;});
          check_all.live("change", function(){
            ul = $(".cfct-accolade-list", $(this).closest(".cfct-accolade-container", container));
            li = $("li", ul);
            if($(this).is(":checked")){
              $("input[type=\'checkbox\']", ul).attr("checked","checked");
              li.addClass("selected");
            }
            else {
              $("input[type=\'checkbox\']", ul).removeAttr("checked");
              li.removeClass("selected");
            }
          });
          $(".cfct-accolade-list li", container).live("mousedown", function(){return false;});
          $("li input[type=\'checkbox\']", container).live("change", function(){
            if($(this).is(":checked")){
              $(this).closest("li").addClass("selected");
            }
            else {
              $(this).closest("li").removeClass("selected");
            }
            var accolade_container = $(this).closest(".cfct-accolade-container", container);
            ul = $(".cfct-accolade-list", accolade_container);
            li = $("li", ul);
            accolade_check_all = $(".cfct-check-all", accolade_container);
            if(li.length==$("input[type=\'checkbox\']", ul).filter(function(){return $(this).is(":checked");}).length){
              accolade_check_all.attr("checked", "checked");
            }
            else {
              accolade_check_all.removeAttr("checked");
            }
          });
          $("#'.$this->get_field_id('type').'", container).live("change", function(){
            var value = $(this).val();
            var accolades_container = $(".cfct-accolade-container", container);
            accolades_container.filter(function(){return !$(this).hasClass("accolade-"+value);}).slideUp("fast");
            accolades_container.filter(function(){return $(this).hasClass("accolade-"+value);}).slideDown("fast");
          });
          $("#'.$this->get_field_id('style').'", container).live("change", function(){
            var value = $(this).val();
            if(value=="featurette"){
              $("#'.$this->get_field_id('interval').'_selector", container).fadeOut("fast");
            }
            else {
              $("#'.$this->get_field_id('interval').'_selector", container).fadeIn("fast");
            }
          });
        });
			');
			return $js;
		}
		
		public function admin_css() {
      return '
        #'.$this->id_base.'-content-fields {
          width: auto;
        }
        #'.$this->id_base.'-image-selectors div#'.$this->id_base.'-image-selector-tabs {
          margin-top: 0;
        }
        textarea#'.$this->id_base.'-content {
          height: 200px;
        }
        #'.$this->id_base.'-styling .cfct-field,
        #'.$this->id_base.'-content-fields .cfct-field {
          margin: 5px 0;
        }
        #'.$this->id_base.'-styling .cfct-field label,
        #'.$this->id_base.'-content-fields .cfct-field label {
          display: inline-block;
          width: 100px;
        }
        #'.$this->id_base.'-content-fields .cfct-field.no-space label {
          width: auto;
          margin-right: 10px;
        }
        #'.$this->id_base.'-content-fields .cfct-field p.help {
          font-style: normal;
          margin-top: 3px;
          margin-bottom: 0;
          font-size: 11px;
        }
        #'.$this->id_base.'-content-fields .cfct-accolade-list {
          display: block;
          border: 1px solid #CCCCCC;
          border-radius: 5px;
          moz-border-radius: 5px;
          o-border-radius: 5px;
          webkit-border-radius: 5px;
          background-color: #FFFFFF;
          padding: 5px;
        }
        #'.$this->id_base.'-content-fields .cfct-accolade-list li {
          margin-bottom: 5px;
          padding: 5px;
          background-color: #FAFAFA;
          border: 1px solid #CCCCCC;
          border-radius: 5px;
          moz-border-radius: 5px;
          o-border-radius: 5px;
          webkit-border-radius: 5px;
        }
        #'.$this->id_base.'-content-fields .cfct-accolade-list li:hover {
          border-color: #999999;
          background-color: #F0F0F0;
        }
        #'.$this->id_base.'-content-fields .cfct-accolade-list li.selected {
          background-color: #333333;
          border-color: #000000;
        }
        #'.$this->id_base.'-content-fields .cfct-accolade-list li.selected .cfct-accolade-title {
          color: #FFFFFF;
        }
        #'.$this->id_base.'-content-fields .cfct-accolade-list li.selected .cfct-accolade-description {
          color: #EEEEEE;
        }
        #'.$this->id_base.'-content-fields .cfct-accolade-checkbox {
          float: left;
          width: 15px;
          margin-right: 5px;
          position: relative;
          z-index: 1;
        }
        #'.$this->id_base.'-content-fields .cfct-accolade-thumb {
          float: left;
          width: 50px;
          height: 50px;
          background-color: #EEEEEE;
          position: relative;
          z-index: 1;
          line-height: 50px;
          text-align: center;
          font-size: 10px;
          whitespace: no-wrap;
          overflow: hidden;
          cursor: default;
          color: #CCCCCC;
          border: 1px solid #CCCCCC;
          border-radius: 3px;
          moz-border-radius: 3px;
          o-border-radius: 3px;
          webkit-border-radius: 3px;
        }
        #'.$this->id_base.'-content-fields li label.cfct-accolade-detail {
          display: block;
          margin-left: 80px;
          min-height: 50px;
          width: auto;
        }
        #'.$this->id_base.'-content-fields .cfct-accolade-title {
          font-weight: bold;
          color: #333333;
          margin-bottom: 5px;
          font-size: 14px;
        }
        #'.$this->id_base.'-content-fields .cfct-accolade-description {
          color: #999999;
          font-size: 12px;
        }
      ';
		}
	}
	cfct_build_register_module('cfct_module_hatch_accolade');
}
?>
