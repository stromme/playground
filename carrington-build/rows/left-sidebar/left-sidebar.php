<?php

if (!class_exists('hatch_left_sidebar')) {
	class hatch_left_sidebar extends cfct_build_row {
		public function __construct() {
			$config = array(
				'name' => __('Left Sidebar', 'carrington-build'),
				'description' => __('Two columns with left sidebar', 'carrington-build'),
				'icon' => 'left-sidebar/icon.png',
        'multi-column' => true
			);
			$this->set_filter_mod('hatch_left_sidebar');
      // For admin view
			$this->push_block(new hatch_block_left_sidebar_1);
			$this->push_block(new hatch_block_left_sidebar_2);
			parent::__construct($config);
		}
	}
	cfct_build_register_row('hatch_left_sidebar');
}

?>