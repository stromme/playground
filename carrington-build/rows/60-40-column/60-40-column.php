<?php

if (!class_exists('hatch_60_40_column')) {
	class hatch_60_40_column extends cfct_build_row {
		public function __construct() {
			$config = array(
				'name' => __('60/40 Column', 'carrington-build'),
				'description' => __('60% and 40% columns', 'carrington-build'),
				'icon' => '60-40-column/icon.png',
        'multi-column' => true
			);
			$this->set_filter_mod('hatch_60_40_column');
      // For admin view
			$this->push_block(new hatch_block_60_40_col_1);
			$this->push_block(new hatch_block_60_40_col_2);
			parent::__construct($config);
		}
	}
	cfct_build_register_row('hatch_60_40_column');
}

?>