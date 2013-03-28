<?php

if (!class_exists('cfct_module_hatch_accolade') && class_exists('cfct_build_module')) {
	class cfct_module_hatch_accolade extends cfct_build_module {
    private $accolades = array(
      'awards' => array('name' => 'Awards', 'content' => array()),
      'news' => array('name' => 'News', 'content' => array()),
      'certifications' => array('name' => 'Certifications', 'content' => array()),
      'insurances' => array('name' => 'Insurances', 'content' => array())
    );
    private $styles = array(
      'header' => 'Header',
      'featurette' => 'Featurette'
    );

		public function __construct() {
			$opts = array(
				'description' => __('Display a headline, (optional) image and brief text with a link.', 'carrington-build'),
				'icon' => 'hatch-accolade/icon.png'
			);
			parent::__construct('cfct-module-hatch-accolade', __('.: Hatch Accolade :.', 'carrington-build'), $opts);

      $args = array(
        'post_type' => array('accolades'),
        'numberposts' => -1,
        'post_status' => 'published',
        'post_parent' => 0,
        'orderby'        => 'post_date',
        'order'          => 'DESC'
      );
      // Do get it
      $accolades_post = get_posts($args);
      if($accolades_post && count($accolades_post)>0){
        foreach($accolades_post as $ac){
          $terms = wp_get_post_terms($ac->ID, 'accolade-types');
          if($terms && count($terms)>0)
          if(count($terms)>1){
            foreach($terms as $term){
              if(isset($this->accolades[$term->slug])){
                array_push($this->accolades[$term->slug]['content'],$ac);
              }
            }
          }
          else {
            array_push($this->accolades[$terms[0]->slug]['content'],$ac);
          }
        }
      }
		}

// Display
		public function display($data) {
      $type = isset($data[$this->get_field_id('type')]) ? $data[$this->get_field_id('type')] : '';
      $accolade_id = isset($data[$this->get_field_id('accolade_id')]) ? $data[$this->get_field_id('accolade_id')] : '';
      $style = (!empty($data[$this->get_field_name('style')]) ? esc_html($data[$this->get_field_name('style')]) : '');
      if($style=='') $style = 'header';
      $style_options = '';
      foreach($this->styles as $key=>$view_style){
        $style_options .= '<option value="'.$key.'"'.(($key==$style)?' selected=""':'').'>'.$view_style.'</option>';
      }

      $image_id = ($data[$this->get_field_id('post_image')]!='')?$data[$this->get_field_id('post_image')]:(($data[$this->get_field_id('global_image')])?$data[$this->get_field_id('global_image')]:'');
      $image = '';
      if (!empty($image_id) && $_img = wp_get_attachment_image_src($image_id, 'large', false)) {
        $image = $_img[0];
      }

      $this->view = 'view-'.$style.'.php';
			return $this->load_view($data);
		}

		public function admin_form($data) {
			// basic info
      $type = (!empty($data[$this->get_field_name('type')]) ? esc_html($data[$this->get_field_name('type')]) : '');
      $accolade_id = isset($data[$this->get_field_name('accolade_id')]) ? $data[$this->get_field_name('accolade_id')] : '';

      $style = (!empty($data[$this->get_field_name('style')]) ? esc_html($data[$this->get_field_name('style')]) : '');
      if($style=='') $style = 'header';
      $style_options = '';
      foreach($this->styles as $key=>$view_style){
        $style_options .= '<option value="'.$key.'"'.(($key==$style)?' selected=""':'').'>'.$view_style.'</option>';
      }

      $accolade_type_keys = array();
      foreach($this->accolades as $key=>$act){
        array_push($accolade_type_keys, $key);
      }
      if($type=='' || !in_array($type, $accolade_type_keys, true)){
        $type = 'awards';
      }
      $type_options = '';
      foreach($this->accolades as $key=>$accolade){
        $type_options .= '<option value="'.$key.'"'.(($key==$type)?' selected=""':'').'>'.$accolade['name'].'</option>';
      }
      $acollade_selection = $this->accolades[$type]['content'];
      $accolade_id_options = '';
      foreach($acollade_selection as $accolade){
        $accolade_id_options .= '<option value="'.$accolade->ID.'"'.(($accolade->ID==$accolade_id)?' selected=""':'').'>'.$accolade->post_title.'</option>';
      }

			$html = '
				<!-- basic info -->
				<div id="'.$this->id_base.'-content-info">
					
					<!-- inputs -->
					<div id="'.$this->id_base.'-content-fields">
						<div class="cfct-field">
							<label for="'.$this->get_field_id('type').'">'.__('Type').'</label>
							<select name="'.$this->get_field_name('type').'" id="'.$this->get_field_id('type').'">'.$type_options.'</select>
						</div>
						<div class="cfct-field">
              <label for="'.$this->get_field_id('style').'">Style</label>
              <select id="'.$this->get_field_id('style').'" name="'.$this->get_field_name('style').'" class="cfct-style-chooser">'.$style_options.'</select>
            </div>
            <div class="cfct-field no-space">
              <label>Select accolades</label>
              <input type="checkbox" value="1" id="'.$this->get_field_id('select_accolades').'" /> <label for="'.$this->get_field_id('select_accolades').'">Select all <span class="accolade-name">'.$this->accolades[$type]['name'].'</span> accolades</label>
            </div>
					</div>
					<!-- /inputs -->
					
				</div>
				<!-- / basic info -->
				<div class="clear" />
				';

			return $html;
		}

		/**
		 * Return a textual representation of this module.
		 *
		 * @param array $data 
		 * @return string
		 */
		public function text($data) {
      $style = isset($data[$this->get_field_id('style')]) ? $data[$this->get_field_id('style')] : '';
      if($style=='') $style = 'header';
      $type = isset($data[$this->get_field_id('type')]) ? $data[$this->get_field_id('type')] : '';
      if($type=='') $type = 'awards';
			return $this->styles[$style]." ".strtolower($this->accolades[$type]['name']);
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

			';
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
        #'.$this->id_base.'-styling .cfct-field label,
        #'.$this->id_base.'-content-fields .cfct-field label {
          display: inline-block;
          width: 75px;
        }
        #'.$this->id_base.'-content-fields .cfct-field.no-space label {
          width: auto;
          margin-right: 10px;
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
	cfct_build_register_module('cfct_module_hatch_accolade');
}
?>
