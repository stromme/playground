<?php

if (!class_exists('cfct_module_hatch_accolade') && class_exists('cfct_build_module')) {
	class cfct_module_hatch_accolade extends cfct_build_module {
    private $accolades = array(
      'awards' => array('name' => 'Awards', 'content' => array()),
      'news' => array('name' => 'News', 'content' => array()),
      'certifications' => array('name' => 'Certifications', 'content' => array()),
      'insurances' => array('name' => 'Insurances', 'content' => array())
    );

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
        foreach($accolades_post as $ac){
          $terms = wp_get_post_terms($ac->ID, 'accolade-types');
          if($terms && count($terms)>0)
          if(count($terms)>1){
            foreach($terms as $term){
              if(isset($this->accolades[$term->slug])){
                array_push($this->accolades[$term->slug]['content'],$ac);
              }
            }
          }
          else {
            array_push($this->accolades[$terms[0]->slug]['content'],$ac);
          }
        }
      }
		}

// Display
		public function display($data) {
      $type = isset($data[$this->get_field_id('type')]) ? $data[$this->get_field_id('type')] : '';
      $style = isset($data[$this->get_field_id('style')]) ? $data[$this->get_field_id('style')] : '';
      if($style=='') $style = 'header';

      $image_id = ($data[$this->get_field_id('post_image')]!='')?$data[$this->get_field_id('post_image')]:(($data[$this->get_field_id('global_image')])?$data[$this->get_field_id('global_image')]:'');
      $image = '';
      if (!empty($image_id) && $_img = wp_get_attachment_image_src($image_id, 'large', false)) {
        $image = $_img[0];
      }

      $this->view = 'view-'.$style.'.php';
			return $this->load_view($data);
		}

		public function admin_form($data) {
			// basic info
      $style = (!empty($data[$this->get_field_name('style')]) ? esc_html($data[$this->get_field_name('style')]) : '');
      $type = (!empty($data[$this->get_field_name('type')]) ? esc_html($data[$this->get_field_name('type')]) : '');
      $type_options = '';
      foreach($this->accolade_types as $key=>$accolade){
        $type_options .= '<option value="'.$key.'"'.(($key==$type)?' selected=""':'').'>'.$accolade.'</option>';
      }
      $accolade_type_keys = array();
      foreach($this->accolade_types as $key=>$act){
        array_push($accolade_type_keys, $key);
      }
      if(!in_array($type, $accolade_type_keys, true)){
        $type = 'awards';
      }
      $acollade_selection = $this->accolades[$type];

      $accolade_id_options = '';
			$html = '
				<!-- basic info -->
				<div id="'.$this->id_base.'-content-info">
					
					<!-- inputs -->
					<div id="'.$this->id_base.'-content-fields">
						<div>
							<label for="'.$this->get_field_id('type').'">'.__('Type').'</label>
							<select name="'.$this->get_field_name('type').'" id="'.$this->get_field_id('type').'">'.$type_options.'</select>
						</div>
						<div>
							<label for="'.$this->get_field_id('content').'">'.__('Content').'</label>
              <select name="'.$this->get_field_name('accolade_id').'" id="'.$this->get_field_id('accolade_id').'">'.$accolade_id_options.'</select>
						</div>
					</div>
					<!-- /inputs -->
					
					<!-- styling -->
					<div class="cfct-post-layout-controls '.$this->id_base.'-c6-34">
						<p class="cfct-style-title-chooser">
						  <label for="'.$this->get_field_id('style').'">Style</label>
              <select id="'.$this->get_field_id('style').'" name="'.$this->get_field_name('style').'" class="cfct-style-chooser">
                <option value="left"'.(($style=='left')?' selected="selected"':'').'>Image left</option>
                <option value="right"'.(($style=='right')?' selected="selected"':'').'>Image right</option>
                <option value="vertical"'.(($style=='vertical')?' selected="selected"':'').'>Vertical</option>
              </select>
            </p>
					</div>
					<!-- /styling -->
					
				</div>
				<!-- / basic info -->
				<div class="clear" />
				';

				// tabs
				$image_selector_tabs = array(
					$this->id_base.'-post-image-wrap' => __('Post Images', 'carrington-build'),
					$this->id_base.'-global-image-wrap' => __('All Images', 'carrington-build')
				);
			
				// set active tab
				$active_tab = $this->id_base.'-post-image-wrap';
				if (!empty($data[$this->get_field_name('global_image')])) {
					$active_tab = $this->id_base.'-global-image-wrap';
				}
				
				$html .= '
					<!-- image selector tabs -->
					<div id="'.$this->id_base.'-image-selectors">
						<!-- tabs -->
						'.$this->cfct_module_tabs($this->id_base.'-image-selector-tabs', $image_selector_tabs, $active_tab).'
						<!-- /tabs -->
					
						<div class="cfct-module-tab-contents">
							<!-- select an image from this post -->
							<div id="'.$this->id_base.'-post-image-wrap" '.(empty($active_tab) || $active_tab == $this->id_base.'-post-image-wrap' ? ' class="active"' : null).'>
								'.$this->post_image_selector($data).'
							</div>
							<!-- / select an image from this post -->
					
							<!-- select an image from media gallery -->
							<div id="'.$this->id_base.'-global-image-wrap" '.($active_tab == $this->id_base.'-global-image-wrap' ? ' class="active"' : null).'>
								'.$this->global_image_selector($data).'
							</div>
							<!-- /select an image from media gallery -->
						</div>';

				$html .= '
					</div>
					<!-- / image selector tabs -->';

        /*$html .= '<fieldset class="cfct-custom-theme-style">
          <div id="cfct-custom-theme-style-chooser" class="cfct-custom-theme-style-chooser cfct-image-select-b">
            <input type="hidden" id="cfct-custom-theme-style" class="cfct-custom-theme-style-input" name="cfct-custom-theme-style" value="">

            <label onclick="cfct_toggle_theme_chooser(this); return false;">Style</label>
            <div class="cfct-image-select-current-image cfct-image-select-items-list-item cfct-theme-style-chooser-current-image" onclick="cfct_toggle_theme_chooser(this); return false;">
              <div class="cfct-image-select-items-list-item">
                <div style="background: #d2cfcf url(http://demo.crowdfavorite.com/favebusiness/wp/wp-content/themes/favebusiness/carrington-build/img/none-icon.png) 50% 50% no-repeat;"></div>
              </div>
            </div>

            <div class="clear"></div>

            <div id="cfct-theme-select-images-wrapper">
              <h4>Select a style...</h4>
              <div class="cfct-image-select-items-list cfct-image-select-items-list-horizontal cfct-theme-select-items-list">
                <ul class="cfct-image-select-items">
                  <li class="cfct-image-select-items-list-item  active" data-image-id="0" onclick="cfct_set_theme_choice(this); return false;">
                    <div style="background: #d2cfcf url(http://demo.crowdfavorite.com/favebusiness/wp/wp-content/themes/favebusiness/carrington-build/img/none-icon.png) no-repeat 50% 50%;"></div>
                  </li>
                  <li class="cfct-image-select-items-list-item" data-image-id="style-a" onclick="cfct_set_theme_choice(this); return false;">
                    <div style="background: url(http://demo.crowdfavorite.com/favebusiness/wp/wp-content/themes/favebusiness/wp-admin/module-callout-previews/box-style-a-loop.png) 0 0 no-repeat;"></div>
                  </li>
                  <li class="cfct-image-select-items-list-item" data-image-id="style-b" onclick="cfct_set_theme_choice(this); return false;">
                    <div style="background: url(http://demo.crowdfavorite.com/favebusiness/wp/wp-content/themes/favebusiness/wp-admin/module-callout-previews/box-style-b-loop.png) 0 0 no-repeat;"></div>
                  </li>
                  <li class="cfct-image-select-items-list-item" data-image-id="style-c" onclick="cfct_set_theme_choice(this); return false;">
                    <div style="background: url(http://demo.crowdfavorite.com/favebusiness/wp/wp-content/themes/favebusiness/wp-admin/module-callout-previews/box-style-c.png) 0 0 no-repeat;"></div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </fieldset>';*/
					
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
      if($style=='') $style = 'left';
      $style_name = "";
      switch($style){
        case 'left': $style_name = "Image left"; break;
        case 'right': $style_name = "Image right"; break;
        case 'vertical': $style_name = "Vertical"; break;
      }
      $style_name .= ': ';
			$title = null;
			if (!empty($data[$this->get_field_name('title')])) {
				$title = esc_html($data[$this->get_field_name('title')]);
			}
			return $style_name.$title.PHP_EOL;
		}

		/**
		 * Modify the data before it is saved, or not
		 *
		 * @param array $new_data 
		 * @param array $old_data 
		 * @return array
		 */
		public function update($new_data, $old_data) {
			// keep the image search field value from being saved
			unset($new_data[$this->get_field_name('global_image-image-search')]);
			
			// make sure that the url is url formatted and scrubbed
			if (!empty($new_data[$this->get_field_name('url')])) {
				$new_data[$this->get_field_name('url')] = esc_url($new_data[$this->get_field_name('url')]);
			}
			
			// normalize the selected image value in to a 'featured_image' value for easy output
			if (!empty($new_data[$this->get_field_name('post_image')])) {
				$new_data[$this->get_field_name('featured_image')] = $new_data[$this->get_field_name('post_image')];
			}
			elseif (!empty($new_data[$this->get_field_name('global_image')])) {
				$new_data[$this->get_field_name('featured_image')] = $new_data[$this->get_field_name('global_image')];
			}
			return $new_data;
		}
		
		public function admin_js() {
			$js = '
				cfct_builder.addModuleLoadCallback("'.$this->id_base.'", function() {
					'.$this->cfct_module_tabs_js().'
				});
				
				cfct_builder.addModuleSaveCallback("'.$this->id_base.'", function() {
					// find the non-active image selector and clear his value
					$("#'.$this->id_base.'-image-selectors .cfct-module-tab-contents>div:not(.active)").find("input:hidden").val("");
					return true;
				});
			';
			$js .= $this->global_image_selector_js('global_image', array('direction' => 'horizontal'));
			return $js;
		}
		
		public function admin_css() {
			return '
				#'.$this->id_base.'-content-fields {
					width: 440px;
					margin-right: 20px;
					float: left;
				}
				#'.$this->id_base.'-content-styles {
					width: 280px;
					float: left;
					margin-top: 20px;
				}
				#'.$this->id_base.'-image-selectors div#'.$this->id_base.'-image-selector-tabs {
					margin-top: 15px;
				}
				textarea#'.$this->id_base.'-content {
					height: 200px;
				}
			';
		}
		
		function post_image_selector($data = false) {
			if (isset($_POST['args'])) {
				$ajax_args = cfcf_json_decode(stripslashes($_POST['args']), true);
			}
			else {
				$ajax_args = null;
			}

			$selected = 0;
			if (!empty($data[$this->get_field_id('post_image')])) {
				$selected = $data[$this->get_field_id('post_image')];
			}

			$selected_size = null;
			if (!empty($data[$this->get_field_name('post_image').'-size'])) {
				$selected_size = $data[$this->get_field_name('post_image').'-size'];
			}

			$args = array(
				'field_name' => 'post_image',
				'selected_image' => $selected,
				'selected_size' => $selected_size,
				'post_id' => isset($ajax_args['post_id']) ? $ajax_args['post_id'] : null,
				'select_no_image' => true,
				'suppress_size_selector' => true
			);

			return $this->image_selector('post', $args);
		}
		
		function global_image_selector($data = false) {		
			$selected = 0;
			if (!empty($data[$this->get_field_id('global_image')])) {
				$selected = $data[$this->get_field_id('global_image')];
			}

			$selected_size = null;
			if (!empty($data[$this->get_field_name('global_image').'-size'])) {
				$selected_size = $data[$this->get_field_name('global_image').'-size'];
			}

			$args = array(
				'field_name' => 'global_image',
				'selected_image' => $selected,
				'selected_size' => $selected_size,
				'suppress_size_selector' => true
			);

			return $this->image_selector('global', $args);
		}

// Content Move Helpers

		protected $reference_fields = array('global_image', 'post_image', 'featured_image');

		public function get_referenced_ids($data) {
			$references = array();			
			foreach ($this->reference_fields as $field) {
				$id = $this->get_data($field, $data);
				if (!is_null($id)) {
					$references[$field] = array(
						'type' => 'post_type',
						'type_name' => 'attachment',
						'value' => $id
					);
				}
			}

			return $references;
		}

		public function merge_referenced_ids($data, $reference_data) {
			if (!empty($reference_data) && !empty($data)) {
				foreach ($this->reference_fields as $field) {
					if (isset($data[$this->gfn($field)])) {
						$data[$this->gfn($field)] = $reference_data[$field]['value'];
					}
				}
			}

			return $data;
		}
	}
	cfct_build_register_module('cfct_module_hatch_accolade');
}
?>
