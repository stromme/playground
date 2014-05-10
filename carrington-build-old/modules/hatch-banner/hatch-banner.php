<?php

if (!class_exists('cfct_module_hatch_banner') && class_exists('cfct_build_module')) {
	class cfct_module_hatch_banner extends cfct_build_module {
		public function __construct() {
			$opts = array(
				'description' => __('Display a Banner', 'carrington-build'),
				'icon' => 'hatch-banner/icon.png'
			);
      parent::__construct('cfct-module-hatch-banner', __('.: Hatch Banner :.', 'carrington-build'), $opts);
		}

// Display
		
		/**
		 * contains capacity to have pre-defined links & image urls,
		 * though that functionality is not exposed in the admin
		 *
		 * @param string $data 
		 * @return void
		 */
		public function display($data) {
			return $this->load_view($data, apply_filters('cbtb_query_banner', array('data'=>$data, 'obj'=>$this)));
		}
		
// Admin

		public function text($data) {
      $banner_type = isset($data[$this->get_field_id('type')]) ? $data[$this->get_field_id('type')] : '';
			return ($banner_type=='smart')?'Smart banner':'Static banner';
		}

		public function admin_form($data) {
      $banner_types = apply_filters(
        'cfct-module-hatch-banner-types',
        array(
          'smart' => 'Smart Banner',
          'static' => 'Static Banner',
        )
      );
      $banner_type = isset($data[$this->get_field_id('type')]) ? $data[$this->get_field_id('type')] : '';
      $banner_type_selection = '';
      foreach ($banner_types as $val => $text) {
        $banner_type_selection .= '
          <option value="'.esc_attr($val).'" '.selected($val, $banner_type, false).'>'.esc_html($text).'</option>
        ';
      }
			// basic info
			$html = '
				<!-- basic info -->
				<div id="'.$this->id_base.'-content-info">

					<!-- inputs -->
					<div id="'.$this->id_base.'-content-fields">
            <div>
              <label for="'.$this->get_field_id('type').'">'.__('Banner Type').'</label>
              <select name="'.$this->get_field_name('type').'" id="'.$this->get_field_id('type').'">'.
              $banner_type_selection.'
              </select>
            </div>
            <div id="'.$this->id_base.'-carousel-interval" style="'.(($banner_type=='static')?'display:none;':'display:block;').'">
              <label for="'.$this->get_field_id('interval').'">'.__('Carousel interval (milliseconds)').'</label>
              <div>
                <input type="text" name="'.$this->get_field_name('interval').'" id="'.$this->get_field_id('interval').'" value="'.(!empty($data[$this->get_field_name('interval')]) ? esc_html($data[$this->get_field_name('interval')]) : '4000').'" class="width-small" />
              </div>
            </div>
            <div id="'.$this->id_base.'-static-fields" style="'.(($banner_type=='static')?'display:block;':'display:none;').'">
              <div>
                <label for="'.$this->get_field_id('description').'">'.__('Description').'</label>
                <textarea name="'.$this->get_field_name('description').'" id="'.$this->get_field_id('description').'">'.(!empty($data[$this->get_field_name('description')]) ? esc_html($data[$this->get_field_name('description')]) : '').'</textarea>
              </div>
              <div>
                <label for="'.$this->get_field_id('author').'">'.__('Author').'</label>
                <input type="text" name="'.$this->get_field_name('author').'" id="'.$this->get_field_id('author').'" value="'.(!empty($data[$this->get_field_name('author')]) ? esc_html($data[$this->get_field_name('author')]) : '').'" />
              </div>
              <div>
                <label for="'.$this->get_field_id('author-location').'">'.__('Author Location').'</label>
                <input type="text" name="'.$this->get_field_name('author-location').'" id="'.$this->get_field_id('author-location').'" value="'.(!empty($data[$this->get_field_name('author-location')]) ? esc_html($data[$this->get_field_name('author-location')]) : '').'" />
              </div>
              <div>
                <label for="'.$this->get_field_id('video').'">'.__('Video').'</label>
                <input type="text" name="'.$this->get_field_name('video').'" id="'.$this->get_field_id('video').'" value="'.(!empty($data[$this->get_field_name('video')]) ? esc_html($data[$this->get_field_name('video')]) : '').'" />
              </div>
            </div>
          </div>
          <!-- /inputs -->
        </div>
        <!-- / basic info -->
        <div class="clear"></div>
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
        <div id="'.$this->id_base.'-image-selectors" style="'.(($banner_type=='static')?'display:block;':'display:none;').'">
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
          </div>
        </div>
        <!-- / image selector tabs -->
      ';

			return $html;
		}
		
		public function update($new, $old) {
			return $new;
		}
		
		public function css() {
			return '';
		}
		
		public function admin_css() {
      return '
        #'.$this->id_base.'-content-fields {
          width: 440px;
          margin-right: 20px;
          float: left;
        }
        #'.$this->id_base.'-image-selectors div#'.$this->id_base.'-image-selector-tabs {
          margin-top: 15px;
        }
      ';
		}
		
		/**
		 * Admin JS functionality
		 *
		 * @uses o-type-ahead.js
		 * @return string
		 */
		public function admin_js() {
      $js = '
        cfct_builder.addModuleLoadCallback("'.$this->id_base.'", function() {
          '.$this->cfct_module_tabs_js().'
          $("#'.$this->get_field_id('type').'").change(function(){
            var fields = $("#'.$this->id_base.'-static-fields");
            var image_field = $("#'.$this->id_base.'-image-selectors");
            var carousel_field = $("#'.$this->id_base.'-carousel-interval");

            if($(this).val()=="static"){
              fields.slideDown("fast");
              image_field.slideDown("fast");
              carousel_field.slideUp("fast");
            }
            else {
              fields.slideUp("fast");
              image_field.slideUp("fast");
              carousel_field.slideDown("fast");
            }
          });
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
		
		public function js() {
			return '
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

      $args = array(
        'field_name' => 'post_image',
        'selected_image' => $selected,
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

      $args = array(
        'field_name' => 'global_image',
        'selected_image' => $selected,
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
	cfct_build_register_module('cfct_module_hatch_banner');
}
?>