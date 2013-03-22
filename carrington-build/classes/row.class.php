<?php
// Define base row class so that it can be extended for different row types
/**
 * We'll need this when we instantiate blocks for rows
 */
require_once(CFCT_BUILD_DIR.'classes/block.class.php');

class cfct_build_row {
	/* Not keen on this defaults property. Should move this stuff into constructor. It's here for backwards-compat for now. */
	private $defaults = array(
		'row_class' => 'row',
		'block_class' => 'cfct-block',
		
		/* do not override these default classes or none of them
		will correspond to needed classes in JS */
		'add_new_module_class' => 'cfct-add-new-module',
		'remove_row_class' => 'cfct-row-delete',
		'row_handle_class' => 'cfct-row-handle'
	);
	protected $config = array();
	protected $filter_key_mod;
	/**
	 * HTML classes to be added to row.
	 */
	protected $classes = array();
	protected $classes_groups = array();
	
	/**
	 * cfct_block instances belonging to this row.
	 */
	protected $blocks = array();
	public $current_module;
	
	public function __construct($config) {
		// Auto-create a filter key modifier if none was set.
		if (!$this->get_filter_mod()) {
			$this->set_filter_mod($this->generate_filter_mod());
		}
		
		/* Leave these here for backwards compatibility
		but we want to move away from ::$defaults and make these part
		of the construction process for the object state rather than a property 
		that is accessed when ever we need a default. */
		$this->defaults = apply_filters('cfct-row-defaults', $this->defaults);
		
		/* Deprecated! $config[class] field.
		Use $this->add_classes(array) instead.
		
		Patching up deprecated config array stuff... */
		$classes = cfct_tpl::extract_classes($this->defaults['row_class']);
		if (!empty($config['class'])) {
			$classes = array_merge(
				$classes,
				cfct_tpl::extract_classes($config['class'])
			);
			unset($config['class']);
		}
		$this->add_classes($classes);
		
		// Allow general classes to be filtered for each row type.
		$key_mod = $this->get_filter_mod();
		$filter_key = $key_mod.'-classes';

		$classes = apply_filters(
			$filter_key, $this->get_classes(), $this
		);
		$this->set_classes($classes);
		
		// Add class for admin class group only
		$this->add_classes(array('cfct-row'), 'admin');
		
		// validate config first...
		$this->config = array_merge($this->config, $config);
	}

// Module integrity check

	/**
	 * Simple validation of module data to check validity
	 *
	 * @param array $module_data 
	 * @param array $build_data 
	 * @return bool
	 */
	public function is_malformed_module_data($module_data, $build_data) {
		// empty is bad, and easy to check
		if (empty($module_data)) {
			return true;
		}
		
		// check required fields
		$required_fields = array(
			'module_type',
			'module_id',
			'block_id'
		);
		foreach ($required_fields as $key) {
			if (empty($module_data[$key])) {
				return true;
			}
		}
		
		// widgets need a widget id
		if ($module_data['module_type'] == 'cfct_module_widget_full') {
			if (empty($module_data['widget_id'])) {
				return true;
			}
		}

		return false;
	}
	
	/**
	 * Auto-generate filter key modifier for making filters unique.
	 * Based on classname.
	 * @return string
	 */
	protected function generate_filter_mod() {
		$class_name = get_class($this);
		$key = strtr($class_name, array(
			'\\' => '',
			'_' => '-'
		));
		return strtolower($key);
	}
	
	/**
	 * Customize the filter key modifier. Useful if you don't want the
	 * auto-generated filter modifier. We use it in our row-types to maintain
	 * backwards compatibility with filter keys.
	 * @param string $key Keep it sane, please. All lowercase and dashes instead of spaces, in most cases.
	 */
	protected function set_filter_mod($key) {
		$this->filter_key_mod = $key;
		return $this;
	}
	
	/**
	 * Gets the current class and turns it into a key that you can add
	 * to your filters to make them unique to the row.
	 * @return string
	 */
	public function get_filter_mod() {
		return $this->filter_key_mod;
	}
	
	/**
	 * Pull the module key from the saved data
	 *
	 * Accommodates widgets having special needs:
	 * Widgets used to be registered with the widget_id that WordPress would generate based on the classname of the widget.
	 * They are now registered differently under a generic classname. When that classname isn't stored we need to try and revert
	 * to the old name that was registered based on the wordpress generated name.
	 *
	 * @param array $module saved module data
	 * @return string the module key used to pull the right output module
	 */
	public function determine_module_key($module) {
	
		$module_key = $module['module_type'];
		
		if (!empty($module['widget_id'])) {
			if (!empty($module['module_id_base'])) {
				$module_key = $module['module_id_base'];
			}
			else {
				$module_key = $module['widget_id'];
			}
		}

		return $module_key;
	}

// row content output

	/**
	 * Process Admin data for output, then pass to builder for return
	 *
	 * @param array $opts 
	 * @param array $data 
	 * @param object $template 
	 * @return string html
	 */
	public function admin(array $opts, array $data = array(), $template) {
		$blocks = array();
		$empty = true;
		
		if (count($this->blocks)) {
			foreach ($this->blocks as $a => $block) {
				$modules = '';
				$blockdata = array_shift($opts['blocks']);
				if (isset($data['blocks'][$blockdata['guid']]) && is_array($data['blocks'][$blockdata['guid']])) {
					foreach ($data['blocks'][$blockdata['guid']] as $module_id) {
						$module = $data['modules'][$module_id];
						
						if ($this->is_malformed_module_data($module, $data)) {
							continue;
						}

						$module_key = $this->determine_module_key($module);

						if ($template->module_type_exists($module_key)) {
							$modules .= $template->get_module($module_key)->_admin('details', $module);
						}
					}
				}
				
				if (!empty($modules)) {
					$empty = false;
				}
				
				$blocks[$a] = $block->as_admin_html(array(
					'{modules}' => $modules,
					'{id}' => $blockdata['guid']
				));

				$blocks_controls[$a] = str_replace(
					'{attrs}',
					$block->attrs_as_string(),
					$this->block_controls($blockdata['guid'])
				);
			}
		}
		
		$html = $this->row_html(true);

    $bumper_top_selections = array(
      array('value'=>'', 'text'=>'none'),
      array('value'=>'bumper-top-small', 'text'=>'Small'),
      array('value'=>'bumper-top', 'text'=>'Normal'),
      array('value'=>'bumper-top-medium', 'text'=>'Medium'),
      array('value'=>'bumper-top-large', 'text'=>'Large'),
      array('value'=>'bumper-top-Xlarge', 'text'=>'Xlarge')
    );
    $bumper_bottom_selections = array(
      array('value'=>'', 'text'=>'none'),
      array('value'=>'bumper-bottom-small', 'text'=>'Small'),
      array('value'=>'bumper-bottom', 'text'=>'Normal'),
      array('value'=>'bumper-bottom-medium', 'text'=>'Medium'),
      array('value'=>'bumper-bottom-large', 'text'=>'Large'),
      array('value'=>'bumper-bottom-Xlarge', 'text'=>'Xlarge')
    );
    $bumper_top_value = ($opts['bumper-top']!='')?$opts['bumper-top']:'';
    $bumper_bottom_value = ($opts['bumper-bottom']!='')?$opts['bumper-bottom']:'';
    $bumper_top_options = '';
    $bumper_bottom_options = '';
    foreach($bumper_top_selections as $option){
      $bumper_top_options .= '<option value="'.$option['value'].'"'.(($option['value']==$bumper_top_value)?' selected="selected"':'').'>'.$option['text'].'</option>';
    }
    foreach($bumper_bottom_selections as $option){
      $bumper_bottom_options .= '<option value="'.$option['value'].'"'.(($option['value']==$bumper_bottom_value)?' selected="selected"':'').'>'.$option['text'].'</option>';
    }
    $page_left_check = ($opts['page-left']!='')?' checked="checked"':'';
    $page_right_check = ($opts['page-right']!='')?' checked="checked"':'';

		$row_values = array(
			'{class}' => $this->row_class(array(), 'admin'),
			'{id}' => $opts['guid'],
      '{post-id}' => $_GET['post'],
      '{classes}' => ($opts['classes']!='')?$opts['classes']:'',
      '{page-left-check}' => $page_left_check,
      '{page-right-check}' => $page_right_check,
      '{bumper-top-options}' => $bumper_top_options,
      '{bumper-bottom-options}' => $bumper_bottom_options
		);

		if ($empty) {
			$row_values['{class}'] .= ' cfct-row-empty';
		}
		
		// handle custom blocks order
		if (isset($this->config['admin_blocks']) && !empty($this->config['admin_blocks'])) {
			$blocks_html = $this->config['admin_blocks'];
			preg_match_all('/{(block_([0-9]))}/', $blocks_html, $match);
			foreach ($match[2] as $key => $block_id) {
				$row_values['{'.$match[1][$key].'}'] = $blocks[$block_id];
				$row_values['{'.$match[1][$key].'_controls}'] = $blocks_controls[$block_id];
				
			}
			$html = str_replace('{row_blocks}', $blocks_html, $html);
		}
		else {
			$html = str_replace('{row_blocks}', $this->row_blocks(), $html);
			$row_values['{blocks}'] = implode('', $blocks);
			$row_values['{blocks_controls}'] = implode('', $blocks_controls);
		}
		$html = str_replace(array_keys($row_values), array_values($row_values), $html);
		
		return apply_filters('cfct-build-row-'.$this->get_filter_mod().'-admin-html', $html);
	}
	
	/**
	 * Get the row in a plain text form with no formatting
	 * Calls 'text' method on each module.
	 * Modules that should not be included in such items as search data should return 
	 * an emtpy value for their textual representation.
	 *
	 * @param array $opts 
	 * @param array $data 
	 * @param string $template 
	 * @return void
	 */
	public function text(array $opts, array $data = array(), $template) {
		$text = '';
		if (count($this->blocks)) {
			foreach ($this->blocks as $a => $block) {
				$blockdata = array_shift($opts['blocks']);
				if (isset($data['blocks'][$blockdata['guid']]) && is_array($data['blocks'][$blockdata['guid']])) {
					foreach ($data['blocks'][$blockdata['guid']] as $module_id) {
						$module = $data['modules'][$module_id];
						if ($this->is_malformed_module_data($module, $data)) {
							continue;
						}
						
						$module_key = $this->determine_module_key($module);
						
						if ($template->module_type_exists($module_key)) {
							$text .= trim($template->get_module($module_key)->_text($module, true)).PHP_EOL;
						}
					}
				}
			}
		}
		return $text;
	}
	
	/**
	 * Process Client data for output, then pass to builder for return
	 *
	 * @param array $opts 
	 * @param array $data 
	 * @param string $template 
	 * @return void
	 */
	public function html(array $opts, array $data = array(), $template) {
		$blocks = array();
		$module_types = array();
		if (count($this->blocks)) {
			foreach ($this->blocks as $a => $block) {
				$modules = '';
				$blockdata = array_shift($opts['blocks']);
				$module_types[$blockdata['guid']] = array();
				
				if (isset($data['blocks'][$blockdata['guid']]) && is_array($data['blocks'][$blockdata['guid']])) {
					foreach ($data['blocks'][$blockdata['guid']] as $module_id) {
						$module = $data['modules'][$module_id];

						if ($this->is_malformed_module_data($module, $data)) {
							continue;
						}
						
						if (isset($module['render']) && !$module['render']) {
							continue;
						}

						$module_key = $this->determine_module_key($module);

						if ($template->module_type_exists($module_key)) {
							$this->current_module = $template->get_module($module_key);
							$modules .= $template->get_module($module_key)->html($module);
							if (!isset($module_types[$blockdata['guid']][$module['module_type']])) {
								$module_types[$blockdata['guid']][$module['module_type']] = $module['module_type'];
							}
							$this->current_module = null;
						}
					}
				}
				
				/* Add last-minute hook for backwards compat plugin
				to add block-$a class */
				$block->add_classes(apply_filters(
					'cfct-generated-block-classes',
					array(),
					$a,
					$block
				));
				
				$blocks[$a] = $block->as_client_html(array(
					'{modules}' => $modules,
					'{id}' => $blockdata['guid']
				));
			}
		}
		
		$html = $this->row_html();
		
		/* Last-minute hook for adding back in the inrow classes that
		were default in last version.
		@see ::add_in_row_classes() */
		$generated_row_classes = apply_filters(
			'cfct-generated-row-classes',
			array(),
			$module_types,
			$this
		);

    $array_classes = array();
    if($opts['classes']!='') array_push($array_classes, $opts['classes']);
    if($opts['bumper-top']!='') array_push($array_classes, $opts['bumper-top']);
    if($opts['bumper-bottom']!='') array_push($array_classes, $opts['bumper-bottom']);
    if($opts['page-left']!='') array_push($array_classes, 'page-left');
    if($opts['page-right']!='') array_push($array_classes, 'page-right');
    $classes = '';
    if(count($array_classes)>0){
      $classes = ' class="'.implode(' ', $array_classes).'"';
    }

		// build row HTML
		$row_values = array(
			'{class}' => $this->row_class($generated_row_classes),
			'{id}' => $opts['guid'],
      '{classes}' => $classes
		);
		
		$row_values['{class}'] = apply_filters(
			'cfct-build-row-'.$this->get_filter_mod().'-classes',
			$row_values['{class}']
		);
		
		// handle custom blocks order
		if (strpos($html, '{blocks}') === false) {
			preg_match_all('/{block_([0-9])}/', $html, $match);
			foreach ($match[1] as $key => $block_id) {
				$row_values[$match[0][$key]] = $blocks[$block_id];
			}
		}
		else {
			$row_values['{blocks}'] = implode('', $blocks);
		}
		
		// put it all together
		$html = str_replace(array_keys($row_values), array_values($row_values), $html);
		return apply_filters(
			'cfct-build-row-'.$this->get_filter_mod().'-html',
			$html
		);
	}

// templates

	/**
	 * row_html
	 * Define row_html defaults
	 *
	 * @param bool $admin 
	 * @return string html
	 */
	public function row_html($admin = false) {
		if ($admin) {
			$html = '
				<div id="{id}" class="{class}" data-row-id="{id}" data-post-id="{post-id}">
					<div class="cfct-row-inner">
					  <div class="cfct-row-option-block">
              <div class="cfct-popup-advanced-actions">
                <div class="cfct-custom-field-line">
                  <label class="cfct-custom-main-label">CSS Classes:</label>
                  <div class="cfct-custom-input-row">
                    <input type="text" class="no-button cfct-custom-classes" data-old-value="{classes}" value="{classes}" autocomplete="off">
                  </div>
                </div>
                <div class="cfct-custom-field-line">
                  <label class="cfct-custom-main-label">Horizontal padding:</label>
                  <div class="cfct-custom-input-row">
                    <input id="page-left-{id}" type="checkbox" value="1" class="cfct-custom-page-left"{page-left-check}></input><label for="page-left-{id}">page-left</label>
                    <input id="page-right-{id}" type="checkbox" value="1" class="cfct-custom-page-right l-10"{page-left-check}></input><label for="page-right-{id}">page-right</label>
                  </div>
                </div>
                <div class="cfct-custom-field-line">
                  <label class="cfct-custom-main-label">Vertical bumper:</label>
                  <div class="cfct-custom-input-row">
                    <label for="bumper-top-{id}">Top</label>
                    <select id="bumper-top-{id}" class="cfct-custom-bumper-top">
                      {bumper-top-options}
                    </select>
                    <label for="bumper-bottom-{id}" class="l-10">Bottom</label>
                    <select id="bumper-bottom-{id}" class="cfct-custom-bumper-bottom">
                      {bumper-bottom-options}
                    </select>
                  </div>
                </div>
                <div class="cfct-custom-field-line action-buttons">
                  <label class="cfct-custom-main-label">&nbsp;</label>
                  <div class="cfct-custom-input-row">
                    <button type="button" class="button button-primary save">Save</button>
                    <button type="button" class="button close">Cancel</button>
                  </div>
                </div>
              </div>
            </div>
						<div title="'.__('Drag and drop to reorder', 'carrington-build').'" class="'.$this->defaults['row_handle_class'].'">
							<a class="'.$this->defaults['remove_row_class'].'" href="#">'.__('Remove', 'carrington-build').'</a>
						</div>
						'.$this->row_table().'
						<div class="cfct-row-option">
              <div class="cfct-build-row-options">
                <h2 class="cfct-build-options-header"><a class="module-options-button">Advanced Options</a></h2>
                <ul class="cfct-build-options-list"><a href="#">Set CSS Classes</a></ul>
              </div>
            </div>
					</div>
				</div>';
		}
		else {
			$config_html = $this->get_config_item('html');
			if (!empty($config_html)) {
				$html = $this->get_config_item('html');
			}
			else if($this->get_config_item('multi-column')) {
				$html = '<section{classes}><div class="row-fluid">{blocks}</div></section>';
			}
			else {
				//$html = '<div class="{class}">{blocks}</div>';
				$html = '<section{classes}>{blocks}</section>';
			}
		}
		return apply_filters('cfct-row-'.($admin ? 'admin-' : '').'html', 
			$html,
			/* Pass as string to avoid breaking backward compatibility
			for this filter */
			$this->make_classname(),
			/* Add new additional parameter for classes as array */
			$this->get_classes(),
			/* Add new additional parameter for row filtermod */
			$this->get_filter_mod()
		);
	}
	
	public function row_table() {
		return '
			<table class="cfct-row-blocks">
				<tbody>
					{row_blocks}
				</tbody>
			</table>';
	}
	
	public function row_blocks() {
		return '
			<tr>
				{blocks}
			</tr>
			<tr class="cfct-build-module-controls">
				{blocks_controls}
			</tr>';
	}
	
	/**
	 * Block registration API.
	 * @param cfct_block $block instance.
	 */
	public function push_block($block) {
		/* Not ideal to be referencing defaults here, since we want to
		deprecate it eventually. For now, though this will maintain backwards
		compat */
		$classes = cfct_tpl::extract_classes($this->defaults['block_class']);
		$block->add_classes($classes);
		$this->blocks[] = $block;
	}
	
	public function block_controls($id = null) {
		$html = '
			<td class="cfct-build-add-module"{attrs}>
				<p><a class="'.$this->defaults['add_new_module_class'].'" href="#'.$id.'"><img class="cfct-icon-add" src="'.CFCT_BUILD_URL.'img/x.gif" alt="Click to" /> '.__('Add Module', 'carrington-build').'</a></p>
			</td>';
		return $html;
	}

// Helpers
	
	/**
	 * Go through the row options and generate guids
	 * Called when processing generation of a blank row
	 *
	 * @param array $opts 
	 * @return array
	 */
	public function process_new($opts) {
		$opts['guid'] = cfct_build_guid($opts['type'], 'row');
		if (empty($opts['blocks']) || !is_array($opts['blocks']) || !count($opts['blocks'])) {
			$blocks = $this->blocks;
			$i=0;
			foreach ($blocks as $block_ins) {
				// Use deprecated block array format
				$block = $block_ins->as_old_array();
				$block['guid'] = cfct_build_guid($block['class'].(++$i), 'block');
				$opts['blocks'][$block['guid']] = $block;
			}
		}
		
		return $opts;
	}
	
	/**
	 * Call this from a filter on 'cfct-generated-row-classes' to add
	 * back the old inrow classes that said what kinds of modules there
	 * were in a row.
	 * Example:
		function my_filter($classes, $module_types, $instance) {
			$classes = $instance->add_in_row_classes($module_types);
			return $classes;
		}
		add_filter('cfct-generated-row-classes', 'my_filter', 10, 3);
	 */
	public function add_in_row_classes($module_types) {
		$modules_in_row = $this->find_modules_in_row($module_types);
		
		/* Adds classes for modules inside of rows. Since this is a bit
		of an edge-case, outputting only on front-end (doesn't modify 
		row instance state). May make this an optional flag in the constructor
		at some point. */
		$generated_classes = array_map(array($this, 'create_in_row_classname'), $modules_in_row);
		return $generated_classes;
	}
	
	public function find_modules_in_row($module_types) {
		$out = array();
		
		// Convert from a list of modules down columns to a list of modules
		// across columns, recording only the first instance of a module.
		// Will stop processing after the 20th module in a given column.
		$n = 0;
		while ($n < 20) {
			$n++;
			if (empty($module_types)) {
				break;
			}
			foreach ($module_types as $module_type_key => $module_type_array) {
				if (empty($module_type_array)) {
					unset($module_types[$module_type_key]);
					continue;
				}
				$module_type_instance = array_shift($module_type_array);
				unset($module_types[$module_type_key][$module_type_instance]);
				if (!in_array($module_type_instance, $out)) {
					$out[] = $module_type_instance;
				}
			}
		}
		return $out;
	}
	
	/**
	 * Turn a module ID string to a row class with various simple transformations.
	 *
	 * @param string $type_string 
	 * @return string row_class
	 */
	private function create_in_row_classname($type_string) {
		$type_string = str_replace('_', '-', $type_string);
		$type_string = str_replace('cfct-module-', '', $type_string);
		$type_string = str_replace('cfct-widget-', 'widget-', $type_string);
		$type_string = str_replace('-module', '', $type_string);
		$type_string = 'cfct-inrow-' . $type_string;
		return $type_string;
	}
		
	/**
	 * Build string of row classes for this row
	 * @param array $classes Ad-hock classes that don't get added
	 * as part of instance. Useful for one-offs.
	 * (was previously string, but nobody was
	 * using this API, so updating should be OK).
	 * @return string
	 */
	private function row_class($classes = array(), $group = null) {
		$row_classes = $this->get_classes($group);
		return cfct_tpl::to_classname($row_classes, $classes);
	}
	
	/**
	 * Add additional classes to a group in this instance (default = general)
	 * @param array $classes
	 */
	public function add_classes($classes = array(), $group = 'general') {
		if (!empty($this->classes_groups[$group])) {
			$classes = array_merge($this->classes_groups[$group], $classes);
		}
		$this->classes_groups[$group] = cfct_tpl::clean_classes($classes);
		return $this;
	}
	
	/**
	 * Set a group of classes (default = general)
	 */
	public function set_classes($classes = array(), $group = 'general') {
		$this->classes_groups[$group] = cfct_tpl::clean_classes($classes);
		return $this;
	}
	
	/**
	 * Get a group of classes (default = general)
	 */
	public function get_classes($group = null) {
		$classes = array();
		if ( $group && !empty($this->classes_groups[$group]) ) {
			$classes = array_merge($classes, $this->classes_groups[$group]);
		}
		if ( !empty($this->classes_groups['general']) ) {
			$classes = array_merge($classes, $this->classes_groups['general']);
		}
		return cfct_tpl::clean_classes($classes);
	}
	
	public function make_classname($group = null) {
		return cfct_tpl::to_classname( $this->get_classes($group) );
	}
	
	/**
	 * Public CSS function to allow row to provide custom CSS
	 * Override in child class to use.
	 *
	 * @return string css
	 */
	public function css() {
		return null;
	}
	
	/**
	 * Admin CSS function to allow additional CSS to be added to the Admin
	 * neck, meet rope.
	 *
	 * @return string
	 */
	public function _admin_css() {
		return null;
	}
	
	/**
	 * Empty block
	 *
	 * @deprecated
	 * @return html
	 */
	public function empty_block() {
		return '<div class="cfct-empty-module">&nbsp;</div>';
	}

// Icon handling

	public function icon() {
		return isset($this->config['icon']) ? $this->config['icon'] : false;
	}

	/**
	 * Get the row icon.
	 * Icon can be defined in $opts['icon'].
	 * Alternately the icon() method can be overridden to return a path if special operations are needed
	 *
	 * @return string - icon url
	 */
	public function get_icon() {
		if ($path = $this->icon()) {
			$icon = $path;			
			if (!preg_match('/^(http)/', $icon)) {
				$icon = CFCT_BUILD_URL.'rows/'.preg_replace('/^(\\/)/', '', $icon);
			}
		}
		else {
			// provide generic icon
			$icon = CFCT_BUILD_URL.'img/row-default-icon.png';
		}
		return apply_filters(
			'cfct-'.$this->get_filter_mod().'-row-icon',
			$icon
		);
	}
	
// Getters

	public function get_name() {
		return $this->config['name'];
	}
	
	public function get_config() {
		return $this->config;
	}
	
	public function get_config_item($key) {
		if (isset($this->config[$key])) {
			return $this->config[$key];
		}
		else {
			return false;
		}
	}
	
	public function get_desc() {
		return isset($this->config['description']) ? $this->config['description'] : null;
	}
	
	/**
	 * Handle pre-1.1 legacy ID attributes that were used to identify modules and rows
	 *
	 * @return string/bool
	 */
	public function _legacy_id() {
		return !empty($this->_deprecated_id) ? $this->_deprecated_id : false;
	}
	
	public function __get($var) {
		if (isset($this->config[$var])) {
			return $this->config[$var];
		}
		return false;
	}
	
	public function __isset($var) {
		return isset($this->config[$var]);
	}
	
	public function __set($var, $val) {
		// setting disabled
		return false;
	}
	
// Revision Manager Integration

	/**
	 * Describe the row contents in human readable form
	 *
	 * @param array $opts 
	 * @param array $data 
	 * @param object $template 
	 * @return string html
	 */
	public function describe(array $opts, array $data, $template) {
		$ret = '
			<li>
				<b>Row Type: '.esc_html($this->get_name()).' ('.$this->make_classname().')</b><br />
				Row Modules:
				<ul style="margin-left: 1.5em; list-style: disc outside;">';
				
		if (count($this->blocks)) {
			foreach ($this->blocks as $a => $block) {
				$blockdata = array_shift($opts['blocks']);
				if (isset($data['blocks'][$blockdata['guid']]) && is_array($data['blocks'][$blockdata['guid']]) && count($data['blocks'][$blockdata['guid']])) {
					foreach ($data['blocks'][$blockdata['guid']] as $module_id) {
						$module = $data['modules'][$module_id];
						$_module = $template->get_module($module['module_type']);
						$ret .= '
							<li>'.trim($_module->get_name()).' ('.$_module->get_id().'): '.trim(esc_html($_module->text($module))).'</li>';
					}
				}
				else {
					$ret .= '<li>Empty Row</li>';
				}
			}
		}
		else {
			$ret .= '<li>Row has no blocks</li>';
		}
		
		$ret .= '
				</ul>
			</li>';
		return $ret;
	}
}

?>
