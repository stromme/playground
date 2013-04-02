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

      $image_id = ($data[$this->get_field_id('post_image')]!='')?$data[$this->get_field_id('post_image')]:(($data[$this->get_field_id('global_image')])?$data[$this->get_field_id('global_image')]:'');
      $image = '';
      if (!empty($image_id) && $_img = wp_get_attachment_image_src($image_id, 'full', false)) {
        $image = $_img[0];
      }

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
			return $this->load_view($data, compact('title', 'heading', 'content', 'content_style', 'border_style', 'image'));
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


				// tabs
				$image_selector_tabs = array(
					$this->id_base.'-post-image-wrap' => __('Post Images', 'carrington-build'),
					$this->id_base.'-global-image-wrap' => __('All Images', 'carrington-build')
				);

				// set active tab
				$active_tab = $this->id_base.'-post-image-wrap';
				if (!empty($data[$this->get_field_name('global_image')])) {
					$active_tab = $this->id_base.'-global-image-wrap';
				}

				$html .= '
					<!-- image selector tabs -->
					<div id="'.$this->id_base.'-image-selectors">
						<!-- tabs -->
						'.$this->cfct_module_tabs($this->id_base.'-image-selector-tabs', $image_selector_tabs, $active_tab).'
						<!-- /tabs -->

						<div class="cfct-module-tab-contents">
							<!-- select an image from this post -->
							<div id="'.$this->id_base.'-post-image-wrap" '.(empty($active_tab) || $active_tab == $this->id_base.'-post-image-wrap' ? ' class="active"' : null).'>
								'.$this->post_image_selector($data).'
							</div>
							<!-- / select an image from this post -->

							<!-- select an image from media gallery -->
							<div id="'.$this->id_base.'-global-image-wrap" '.($active_tab == $this->id_base.'-global-image-wrap' ? ' class="active"' : null).'>
								'.$this->global_image_selector($data).'
							</div>
							<!-- /select an image from media gallery -->
						</div>
					</div>
					<!-- / image selector tabs -->';
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

    /**
  		 * Modify the data before it is saved, or not
  		 *
  		 * @param array $new_data
  		 * @param array $old_data
  		 * @return array
  		 */
    public function update($new_data, $old_data) {
      // keep the image search field value from being saved
      unset($new_data[$this->get_field_name('global_image-image-search')]);

      // make sure that the url is url formatted and scrubbed
      if (!empty($new_data[$this->get_field_name('url')])) {
        $new_data[$this->get_field_name('url')] = esc_url($new_data[$this->get_field_name('url')]);
      }

      // normalize the selected image value in to a 'featured_image' value for easy output
      if (!empty($new_data[$this->get_field_name('post_image')])) {
        $new_data[$this->get_field_name('featured_image')] = $new_data[$this->get_field_name('post_image')];
      }
      elseif (!empty($new_data[$this->get_field_name('global_image')])) {
        $new_data[$this->get_field_name('featured_image')] = $new_data[$this->get_field_name('global_image')];
      }
      return $new_data;
    }

    public function admin_js() {
      $js = '
        cfct_builder.addModuleLoadCallback("'.$this->id_base.'", function() {
          '.$this->cfct_module_tabs_js().'
        });

        cfct_builder.addModuleSaveCallback("'.$this->id_base.'", function() {
          // find the non-active image selector and clear his value
          $("#'.$this->id_base.'-image-selectors .cfct-module-tab-contents>div:not(.active)").find("input:hidden").val("");
          return true;
        });
      ';
      $js .= $this->global_image_selector_js('global_image', array('direction' => 'horizontal'));
      return $js;
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


    function post_image_selector($data = false) {
      if (isset($_POST['args'])) {
        $ajax_args = cfcf_json_decode(stripslashes($_POST['args']), true);
      }
      else {
        $ajax_args = null;
      }

      $selected = 0;
      if (!empty($data[$this->get_field_id('post_image')])) {
        $selected = $data[$this->get_field_id('post_image')];
      }

      $selected_size = null;
      if (!empty($data[$this->get_field_name('post_image').'-size'])) {
        $selected_size = $data[$this->get_field_name('post_image').'-size'];
      }

      $args = array(
        'field_name' => 'post_image',
        'selected_image' => $selected,
        'selected_size' => $selected_size,
        'post_id' => isset($ajax_args['post_id']) ? $ajax_args['post_id'] : null,
        'select_no_image' => true,
        'suppress_size_selector' => true
      );

      return $this->image_selector('post', $args);
    }

    function global_image_selector($data = false) {
      $selected = 0;
      if (!empty($data[$this->get_field_id('global_image')])) {
        $selected = $data[$this->get_field_id('global_image')];
      }

      $selected_size = null;
      if (!empty($data[$this->get_field_name('global_image').'-size'])) {
        $selected_size = $data[$this->get_field_name('global_image').'-size'];
      }

      $args = array(
        'field_name' => 'global_image',
        'selected_image' => $selected,
        'selected_size' => $selected_size,
        'suppress_size_selector' => true
      );

      return $this->image_selector('global', $args);
    }

  // Content Move Helpers

    protected $reference_fields = array('global_image', 'post_image', 'featured_image');

    public function get_referenced_ids($data) {
      $references = array();
      foreach ($this->reference_fields as $field) {
        $id = $this->get_data($field, $data);
        if (!is_null($id)) {
          $references[$field] = array(
            'type' => 'post_type',
            'type_name' => 'attachment',
            'value' => $id
          );
        }
      }

      return $references;
    }

    public function merge_referenced_ids($data, $reference_data) {
      if (!empty($reference_data) && !empty($data)) {
        foreach ($this->reference_fields as $field) {
          if (isset($data[$this->gfn($field)])) {
            $data[$this->gfn($field)] = $reference_data[$field]['value'];
          }
        }
      }

      return $data;
    }
	}
	cfct_build_register_module('cfct_module_hatch_jumbotron');
}
?>
