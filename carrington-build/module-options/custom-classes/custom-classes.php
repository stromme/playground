<?php

/**
 * Custom Class Attributes
 *
 * Provides an input on modules to allow input of additional CSS classes
 * to be applied to the Module div when the HTML is rendered.
 *
 * @package Carrington Build
 */
class cfct_module_option_custom_classes extends cfct_module_option {
	
	public function __construct() {
		parent::__construct('Set CSS Classes', 'custom-classes');
		add_filter('cfct-build-module-class', array($this, 'apply_classes'), 10, 2);
	}

	/**
	 * Non-standard module options method to filter in our custom classes in to the
	 * module's class attribute. Uses a standard filter in CB
	 *
	 * @param string $class
	 * @param array $data
	 * @return string
	 */
	public function apply_classes($class, $data) {
		if (!empty($data['cfct-module-options'][$this->id_base]['custom-css'])) {
			$classes = cfct_tpl::extract_classes($class);
			$class = cfct_tpl::to_classname(
				$classes,
				$data['cfct-module-options'][$this->id_base]['custom-css']
			);
		}
		return $class;
	}

	public function form($data, $module_type) {
		$dropdown_opts = apply_filters('cfct-module-predefined-class-options', cfct_class_groups('wrapper'));
		$predefined_classes = array();
		$input_class = (empty($dropdown_opts) ? 'no-button' : null);
		
		$value = null;
		if (!isset($data['custom-css'])) {
			$data['custom-css'] = array();
		}
		if (!empty($data['custom-css'])) {
			$value = implode(' ', array_map('esc_attr', $data['custom-css']));
		}

    $bumper_left_selections = array(
      array('value'=>'', 'text'=>'none'),
      array('value'=>'bumper-left', 'text'=>'Normal'),
      array('value'=>'bumper-left-medium', 'text'=>'Medium'),
      array('value'=>'bumper-left-large', 'text'=>'Large'),
    );
    $bumper_right_selections = array(
      array('value'=>'', 'text'=>'none'),
      array('value'=>'bumper-right', 'text'=>'Normal'),
      array('value'=>'bumper-right-medium', 'text'=>'Medium'),
      array('value'=>'bumper-right-large', 'text'=>'Large'),
    );
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
    $bumper_left = (isset($data['bumper-left']) && $data['bumper-left']!='')?$data['bumper-left']:'';
    $bumper_right = (isset($data['bumper-right']) && $data['bumper-right']!='')?$data['bumper-right']:'';
    $bumper_top = (isset($data['bumper-top']) && $data['bumper-top']!='')?$data['bumper-top']:'';
    $bumper_bottom = (isset($data['bumper-bottom']) && $data['bumper-bottom']!='')?$data['bumper-bottom']:'';
    $bumper_left_options = '';
    $bumper_right_options = '';
    $bumper_top_options = '';
    $bumper_bottom_options = '';
    foreach($bumper_left_selections as $option){
      $bumper_left_options .= '<option value="'.$option['value'].'"'.(($option['value']==$bumper_left)?' selected="selected"':'').'>'.$option['text'].'</option>';
    }
    foreach($bumper_right_selections as $option){
      $bumper_right_options .= '<option value="'.$option['value'].'"'.(($option['value']==$bumper_right)?' selected="selected"':'').'>'.$option['text'].'</option>';
    }
    foreach($bumper_top_selections as $option){
      $bumper_top_options .= '<option value="'.$option['value'].'"'.(($option['value']==$bumper_top)?' selected="selected"':'').'>'.$option['text'].'</option>';
    }
    foreach($bumper_bottom_selections as $option){
      $bumper_bottom_options .= '<option value="'.$option['value'].'"'.(($option['value']==$bumper_bottom)?' selected="selected"':'').'>'.$option['text'].'</option>';
    }

		$html = '
		  <div class="cfct-custom-field-line">
				<label for="" class="cfct-custom-main-label">CSS Classes:</label>
				<div class="cfct-select-menu-wrapper">
					<input type="text" class="'.$input_class.'" name="'.$this->get_field_name('custom-css').'" id="'.$this->get_field_id('custom-css').'" value="'.$value.'"  autocomplete="off" />';
		if (is_array($dropdown_opts) && !empty($dropdown_opts)) {
		$html .= '<input type="button" name="" id="'.$this->get_field_id('class-list-toggle').'" class="cfct-button cfct-button-dark" value="">
					<div id="'.$this->get_field_id('class-list-menu').'" class="cfct-select-menu" style="display: none;">
						<ul>';
		foreach($dropdown_opts as $classname => $title) {
			$class = (isset($data['custom-css']) && in_array($classname, $data['custom-css']) ? 'inactive' : null);
			$html .= '
							<li><a class="'.$class.'" href="#'.esc_attr($classname).'" title="'.esc_attr($title).'">'.esc_html($classname).'</a></li>';
		}
		$html .= '
						</ul>
					</div>';
		}
		$html .= '
				</div>
			</div>
    ';

    $html .= '
      <div class="cfct-custom-field-line">
        <label for="" class="cfct-custom-main-label custom-bumper-label">Bumper:</label>
        <table class="cfct-custom-bumper-table">
          <tr>
            <td class="right-text">Top</td>
            <td>
              <select name="'.$this->get_field_name('bumper-top').'" id="'.$this->get_field_id('bumper-top').'" >'.$bumper_top_options.'</select>
            </td>
            <td></td>
          </tr>
          <tr>
            <td>
              Left <select name="'.$this->get_field_name('bumper-left').'" id="'.$this->get_field_id('bumper-left').'" >'.$bumper_left_options.'</select>
            </td>
            <td class="right-text">Right</td>
            <td>
              <select name="'.$this->get_field_name('bumper-right').'" id="'.$this->get_field_id('bumper-right').'" >'.$bumper_right_options.'</select>
            </td>
          </tr>
          <tr>
            <td class="right-text">Bottom</td>
            <td>
              <select name="'.$this->get_field_name('bumper-bottom').'" id="'.$this->get_field_id('bumper-bottom').'" >'.$bumper_bottom_options.'</select>
            </td>
            <td></td>
          </tr>
        </table>
			</div>
    ';
		return $html;
	}
	
	public function admin_js() {
		$js = '
// Module Extra: Custom CSS			
	// show/hide the pre-defined css list from toggle button
	$(document).on("click", "#'.$this->get_field_id('class-list-toggle').'", function() {
		var tgt = $(this).siblings("div.cfct-select-menu");
		
		// check to see if any pre-defined class names need toggling before opening the drawer
		if (tgt.is(":hidden")) {
			toggle_css_module_options_list_use();
		}
		
		tgt.toggle();
		return false;
	});
	
	// show the pre-defined css list when input is focused
	$(document).on("click", "#'.$this->get_field_id('custom-css').'", function(e) {
		var tgt = $(this).siblings("div.cfct-select-menu");
		if (tgt.is(":hidden")) {
			toggle_css_module_options_list_use();
			tgt.show();
		}
		return false;
	});
	
	$(document).on("keyup", "#'.$this->get_field_id('custom-css').'", function() {
		setTimeout(toggle_css_module_options_list_use, 200);
	});
	
	// catch a click in the popup and close the flyout
	$(document).on("click", "#cfct-popup", function(){
		$("#'.$this->get_field_id('class-list-menu').':visible").hide();
	});

	var toggle_css_module_options_list_use = function() {
		var classes = $("#'.$this->get_field_id('custom-css').'").val().split(" ");
		$("#'.$this->get_field_id('class-list-menu').' a").each(function(){
			var _this = $(this);
			if ($.inArray(_this.text(),classes) == -1) {
				_this.removeClass("inactive");
			}
			else {
				_this.addClass("inactive");
			}
		});
	}

	// insert the clicked item in to the text-input
	$(document).on("click", "#'.$this->get_field_id('class-list-menu').' a", function(e) {
		_this = $(this);
		if (!_this.hasClass("inactive")) {
			_this.addClass("inactive");
			var tgt = $("#'.$this->get_field_id('custom-css').'");
			tgt.val(tgt.val() + " " +_this.text());
		}
		return false;
	});
	
	$(document).on("click", "#'.$this->get_field_id('class-list-menu').'", function() {
		return false;
	});	
			';
		return $js;
	}
	
	public function update($new_data, $old_data) {
		$ret = array();
		
		$classes = explode(' ', $new_data['custom-css']);
		if (is_array($classes)) {
			foreach($classes as $class) {
				$ret['custom-css'][] = sanitize_title_with_dashes(trim(strip_tags($class)));
			}
		}
		
		return $ret;
	}
}

cfct_module_register_extra('cfct_module_option_custom_classes');
	
?>
