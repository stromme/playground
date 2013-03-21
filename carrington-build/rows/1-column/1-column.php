<?php

if (!class_exists('hatch_1_column')) {
	class hatch_1_column extends cfct_build_row {
		public function __construct() {
			$config = array(
				'name' => __('1 Column', 'carrington-build'),
				'description' => __('A single full-width column', 'carrington-build'),
				'icon' => '1-column/icon.png'
			);
			$this->set_filter_mod('hatch_1_column');
			$this->push_block(new hatch_block_1_col);
			parent::__construct($config);
		}
	}
	cfct_build_register_row('hatch_1_column');
}

?>