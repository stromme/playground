<?php

if (!class_exists('hatch_2_column')) {
	class hatch_2_column extends cfct_build_row {
		public function __construct() {
			$config = array(
				'name' => __('2 Column', 'carrington-build'),
				'description' => __('Two columns', 'carrington-build'),
				'icon' => '2-column/icon.png',
        'multi-column' => true
			);
			$this->set_filter_mod('hatch_2_column');
      // For admin view
			$this->push_block(new hatch_block_2_col_1);
			$this->push_block(new hatch_block_2_col_2);
			parent::__construct($config);
		}
	}
	cfct_build_register_row('hatch_2_column');
}

?>