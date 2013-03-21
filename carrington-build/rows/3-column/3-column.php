<?php

if (!class_exists('hatch_3_column')) {
	class hatch_3_column extends cfct_build_row {
		public function __construct() {
			$config = array(
				'name' => __('3 Column', 'carrington-build'),
				'description' => __('Two columns', 'carrington-build'),
				'icon' => '3-column/icon.png',
        'multi-column' => true
			);
			$this->set_filter_mod('hatch_3_column');
      // For admin view
			$this->push_block(new hatch_block_3_col_1);
			$this->push_block(new hatch_block_3_col_2);
			$this->push_block(new hatch_block_3_col_3);
			parent::__construct($config);
		}
	}
	cfct_build_register_row('hatch_3_column');
}

?>