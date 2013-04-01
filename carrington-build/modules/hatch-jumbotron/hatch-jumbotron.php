<?php

if (!class_exists('cfct_module_hatch_jumbotron') && class_exists('cfct_build_module')) {
	class cfct_module_hatch_jumbotron extends cfct_build_module {
    private $heading_styles = array(
      'h2' => 'H2 (Heading 2)',
      'h3' => 'H3 (Heading 3)',
      'h4' => 'H4 (Heading 4)'
    );
    private $default_heading_style = 'h2';
    private $content_styles = array(
      'h3' => 'H3 (Heading 3)',
      'h4' => 'H4 (Heading 4)',
      'p' => 'P (Paragraph)'
    );
    private $default_content_style = 'h3';
    private $border_style = array(
      '' => 'Squared',
      'round' => 'Round top'
    );
    private $default_border_style = '';

		public function __construct() {
			$opts = array(
				'description' => __('Display a headline and brief text.', 'carrington-build'),
				'icon' => 'hatch-jumbotron/icon.png'
			);
			parent::__construct('cfct-module-hatch-jumbotron', __('.: Hatch Jumbo Tron :.', 'carrington-build'), $opts);
		}

// Display
		public function display($data) {
      $title = isset($data[$this->get_field_id('title')]) ? $data[$this->get_field_id('title')] : '';
      $content = isset($data[$this->get_field_id('content')]) ? $data[$this->get_field_id('content')] : '';

      $heading = (!empty($data[$this->get_field_name('heading_style')]) ? esc_html($data[$this->get_field_name('heading_style')]) : '');
      if($heading=='') $heading = $this->default_heading_style;

      $content_style = (!empty($data[$this->get_field_name('content_style')]) ? esc_html($data[$this->get_field_name('content_style')]) : '');
      if($content_style=='') $content_style = $this->default_content_style;

      /*$border_style = (!empty($data[$this->get_field_name('border_style')]) ? esc_html($data[$this->get_field_name('border_style')]) : '');
      if($border_style=='') $border_style = $this->default_border_style;*/

      $border_style = $this->default_border_style;
      $build_data = get_post_meta($this->get_post_id(), CFCT_BUILD_POSTMETA, true);
      $first_row = false;
      $module_id = $data['module_id'];
      if(isset($build_data['data']['blocks'])){
        foreach($build_data['data']['blocks'] as $block){
          foreach($block as $module){
            if($module==$module_id) $first_row = true;
            break;
          }
          break;
        }
      }
      if($first_row) $border_style = 'round';
			return $this->load_view($data, compact('title', 'heading', 'content', 'content_style', 'border_style', 'build_data', 'module_id'));
		}

		public function admin_form($data) {
			// basic info
      $heading_style = (!empty($data[$this->get_field_name('heading_style')]) ? esc_html($data[$this->get_field_name('heading_style')]) : '');
      $heading_style_options = '';
      foreach($this->heading_styles as $key=>$head_style){
        $heading_style_options .= '<option value="'.$key.'"'.(($key==$heading_style)?' selected=""':'').'>'.$head_style.'</option>';
      }
      $content_style = (!empty($data[$this->get_field_name('content_style')]) ? esc_html($data[$this->get_field_name('content_style')]) : '');
      $content_style_options = '';
      foreach($this->content_styles as $key=>$current_content_style){
        $content_style_options .= '<option value="'.$key.'"'.(($key==$content_style)?' selected=""':'').'>'.$current_content_style.'</option>';
      }
      /*$border_style = (!empty($data[$this->get_field_name('border_style')]) ? esc_html($data[$this->get_field_name('border_style')]) : '');
      if($border_style=='') $border_style=$this->default_border_style;
      $border_style_options = '';
      foreach($this->border_style as $key=>$block_border_style){
        $border_style_options .= '<option value="'.$key.'"'.(($key==$border_style)?' selected=""':'').'>'.$block_border_style.'</option>';
      }*/
			$html = '
				<div id="'.$this->id_base.'-content-info">
					<div id="'.$this->id_base.'-content-fields">
					  <div class="cfct-field">
              <label for="'.$this->get_field_id('title').'">'.__('Title').'</label>
              <input type="text" name="'.$this->get_field_name('title').'" id="'.$this->get_field_id('title').'" value="'.(!empty($data[$this->get_field_name('title')]) ? esc_html($data[$this->get_field_name('title')]) : '').'" />
              <p class="help">Use <em>shortclass</em> to add color. Ex: We are the [green]best[/] window cleaner.</p>
            </div>
					</div>
					<div id="'.$this->id_base.'-styling">
            <div class="cfct-field">
              <div>
                <label for="'.$this->get_field_id('heading_style').'">Heading style</label>
              </div>
              <div>
                <select id="'.$this->get_field_id('heading_style').'" name="'.$this->get_field_name('heading_style').'" class="cfct-style-chooser">'.$heading_style_options.'</select>
              </div>
            </div>
					</div>
				</div>
				<div id="'.$this->id_base.'-content-info">
				  <div id="'.$this->id_base.'-content-fields">
						<div class="cfct-field">
							<label for="'.$this->get_field_id('content').'">'.__('Content').'</label>
							<textarea name="'.$this->get_field_name('content').'" id="'.$this->get_field_id('content').'">'
								.(!empty($data[$this->get_field_name('content')]) ? htmlspecialchars($data[$this->get_field_name('content')]) : '').
							'</textarea>
						</div>
					</div>
          <div id="'.$this->id_base.'-styling">
            <div class="cfct-field">
              <label for="'.$this->get_field_id('content_style').'">Style</label>
              <div>
                <select id="'.$this->get_field_id('content_style').'" name="'.$this->get_field_name('content_style').'" class="cfct-style-chooser">'.$content_style_options.'</select>
              </div>
            </div>'.
            /*<div class="cfct-field">&nbsp;</div>
            <div class="cfct-field">
              <label for="'.$this->get_field_id('border_style').'">Border style</label>
              <div>
                <select id="'.$this->get_field_id('border_style').'" name="'.$this->get_field_name('border_style').'">'.$border_style_options.'</select>
              </div>
            </div>*/'
          </div>
				</div>
				<div class="clear"></div>';
			return $html;
		}

		/**
		 * Return a textual representation of this module.
		 *
		 * @param array $data 
		 * @return string
		 */
		public function text($data) {
      $title = '';
			if (!empty($data[$this->get_field_name('title')])) {
				$title = esc_html($data[$this->get_field_name('title')]);
			}
			return $title.PHP_EOL;
		}

		public function admin_js() {
			return '';
		}
		
		public function admin_css() {
			return '
				#'.$this->id_base.'-content-fields {
					width: 440px;
					margin-right: 20px;
					float: left;
				}
				#'.$this->id_base.'-image-selectors div#'.$this->id_base.'-image-selector-tabs {
					margin-top: 0;
				}
				textarea#'.$this->id_base.'-content {
					height: 200px;
				}
				#'.$this->id_base.'-styling {
				  float: left;
				}
				#'.$this->id_base.'-styling .cfct-field,
			  #'.$this->id_base.'-content-fields .cfct-field {
				  margin: 5px 0;
				}
				#'.$this->id_base.'-styling .cfct-field label {
				  display: inline-block;
				  width: 75px;
				}
				#'.$this->id_base.'-content-fields .cfct-field p.help {
				  font-style: normal;
				  margin-top: 3px;
				  margin-bottom: 0;
				  font-size: 11px;
				}
			';
		}
	}
	cfct_build_register_module('cfct_module_hatch_jumbotron');
}
?>
