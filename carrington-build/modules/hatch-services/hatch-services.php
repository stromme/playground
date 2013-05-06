<?php

if (!class_exists('cfct_module_hatch_services') && class_exists('cfct_build_module')) {
	class cfct_module_hatch_services extends cfct_build_module {
    private $default_title = 'What we\'re [strong green]really[/] good at.';

		public function __construct() {
			$opts = array(
				'description' => __('Display services', 'carrington-build'),
				'icon' => 'hatch-services/icon.png'
			);
      parent::__construct('cfct-module-hatch-services', __('.: Hatch Services :.', 'carrington-build'), $opts);
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
      $title = isset($data[$this->get_field_id('title')]) ? stripslashes($data[$this->get_field_id('title')]) : stripslashes($this->default_title);
      $services = get_terms('services', array('hide_empty' => 0, 'orderby' => 'post_date', 'order' => 'DESC'));
			return $this->load_view($data, compact('title', 'services'));
		}

// Admin

		public function text($data) {
      $title = isset($data[$this->get_field_id('title')]) ? $data[$this->get_field_id('title')] : $this->default_title;
      return $title.PHP_EOL;
		}

		public function admin_form($data) {
			// basic info
      $title = (!empty($data[$this->get_field_name('title')]) ? esc_html($data[$this->get_field_name('title')]) : $this->default_title);
      $html = '
        <div id="'.$this->id_base.'-content-info">
          <div id="'.$this->id_base.'-content-fields">
            <div class="cfct-field">
              <label for="'.$this->get_field_id('title').'">'.__('Title').'</label>
              <input type="text" name="'.$this->get_field_name('title').'" id="'.$this->get_field_id('title').'" value="'.$title.'" />
            </div>
          </div>
        </div>
        <div class="clear"></div>';
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
        #'.$this->id_base.'-content-fields .cfct-field {
          margin: 5px 0;
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
      return '';
		}

		public function js() {
			return '';
		}
	}
	cfct_build_register_module('cfct_module_hatch_services');
}
?>