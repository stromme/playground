<?php

if (!class_exists('hatch_40_60_column')) {
	class hatch_40_60_column extends cfct_build_row {
		public function __construct() {
			$config = array(
				'name' => __('40/60 Column', 'carrington-build'),
				'description' => __('40% and 60% columns', 'carrington-build'),
				'icon' => '40-60-column/icon.png',
        'multi-column' => true
			);
			$this->set_filter_mod('hatch_40_60_column');
      // For admin view
			$this->push_block(new hatch_block_40_60_col_1);
			$this->push_block(new hatch_block_40_60_col_2);
			parent::__construct($config);
		}
	}
	cfct_build_register_row('hatch_40_60_column');
}

?>