<?php

/**
 * 3 Column Row
 *
 * @package Carrington Build
 */
if (!class_exists('cfct_row_abcd')) {
	class cfct_row_abcd extends cfct_build_row {
		protected $_deprecated_id = 'row-abcd'; // deprecated property, not needed for new module development

		public function __construct() {
			$config = array(
				'name' => __('4 Column', 'carrington-build'),
				'description' => __('A 4 column row.', 'carrington-build'),
				'icon' => '4col/icon.png'
			);

			/* Filters in rows used to be keyed by the single classname
			that was registered for the class. Maintain backwards
			compatibility for filters by setting modifier for this row to
			the old classname property. */
			$this->set_filter_mod('cfct-row-a-b-c-d');

			$this->add_classes(array('row-c4-1-2-3-4'));

			$this->push_block(new cfct_block_c4_1);
			$this->push_block(new cfct_block_c4_2);
			$this->push_block(new cfct_block_c4_3);
			$this->push_block(new cfct_block_c4_4);

			parent::__construct($config);
		}
	}
	//cfct_build_register_row('cfct_row_abcd');
}

?>