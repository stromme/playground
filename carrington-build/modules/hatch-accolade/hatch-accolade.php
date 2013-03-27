<?php

if (!class_exists('cfct_module_hatch_accolade') && class_exists('cfct_build_module')) {
	class cfct_module_hatch_accolade extends cfct_build_module {
		public function __construct() {
			$opts = array(
				'description' => __('Display accolade', 'carrington-build'),
				'icon' => 'hatch-accolade/icon.png'
			);
      parent::__construct('cfct-module-hatch-accolade', __('.: Hatch Accolade :.', 'carrington-build'), $opts);
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
			return $this->load_view($data);
		}

// Admin

		public function text($data) {
			return "Accolade";
		}

		public function admin_form($data) {
			// basic info
			$html = '
				<!-- basic info -->
				<div id="'.$this->id_base.'-content-info">
					<!-- inputs -->
					<div id="'.$this->id_base.'-content-fields">
            <div>
              <label>'.__('Currently no options for this module, just click save and you\'re done.').'</label>
            </div>
          </div>
          <!-- /inputs -->
        </div>
        <!-- / basic info -->
        <div class="clear"></div>
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
      return '';
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
	cfct_build_register_module('cfct_module_hatch_accolade');
}
?>