<?php

if (!class_exists('hatch_right_sidebar')) {
	class hatch_right_sidebar extends cfct_build_row {
		public function __construct() {
			$config = array(
				'name' => __('Right Sidebar', 'carrington-build'),
				'description' => __('Two columns with right sidebar', 'carrington-build'),
				'icon' => 'right-sidebar/icon.png',
        'multi-column' => true
			);
			$this->set_filter_mod('hatch_right_sidebar');
      // For admin view
			$this->push_block(new hatch_block_right_sidebar_1);
			$this->push_block(new hatch_block_right_sidebar_2);
			parent::__construct($config);
		}
	}
	cfct_build_register_row('hatch_right_sidebar');
}

?>