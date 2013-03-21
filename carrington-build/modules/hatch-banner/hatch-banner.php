<?php

if (!class_exists('cfct_module_hatch_banner') && class_exists('cfct_build_module')) {
	class cfct_module_hatch_banner extends cfct_build_module {
		protected $context_excludes = array(
			'multi-module'
		);

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
			return $this->load_view($data);
		}
		
// Admin

		public function text($data) {
			return 'Hatch Banner';
		}

		public function admin_form($data) {
			return '';
		}
		
		public function update($new, $old) {
			return $new;
		}
		
		public function css() {
			return preg_replace('/^(\t){4}/m', '', '
			');
		}
		
		public function admin_css() {
			return preg_replace('/^(\t){4}/m', '', '
			');
		}
		
		/**
		 * Admin JS functionality
		 *
		 * @uses o-type-ahead.js
		 * @return string
		 */
		public function admin_js() {
			$js_base = str_replace('-', '_', $this->id_base);
			$js = preg_replace('/^(\t){4}/m', '', '
      ');
			return $js;
		}
		
		public function js() {
			return '
			';
		}
	}
	cfct_build_register_module('cfct_module_hatch_banner');
}
?>