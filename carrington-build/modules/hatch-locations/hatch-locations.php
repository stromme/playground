<?php

if (!class_exists('cfct_module_hatch_locations') && class_exists('cfct_build_module')) {
	class cfct_module_hatch_locations extends cfct_build_module {
    private $default_title = 'Where we work';
		public function __construct() {
			$opts = array(
				'description' => __('Display company locations.', 'carrington-build'),
				'icon' => 'hatch-locations/icon.png'
			);
			parent::__construct('cfct-module-hatch-locations', __('.: Hatch Locations :.', 'carrington-build'), $opts);
		}

// Display
		public function display($data) {
      $title = isset($data[$this->get_field_id('title')]) ? $data[$this->get_field_id('title')] : $this->default_title;
      $company = get_option('tb_company');
			return $this->load_view($data, compact('title', 'company'));
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

		/**
		 * Return a textual representation of this module.
		 *
		 * @param array $data 
		 * @return string
		 */
		public function text($data) {
      $title = isset($data[$this->get_field_id('title')]) ? $data[$this->get_field_id('title')] : $this->default_title;
			return $title.PHP_EOL;
		}

		public function admin_js() {
			$js = '';
			return $js;
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
	}
	cfct_build_register_module('cfct_module_hatch_locations');
}
?>
