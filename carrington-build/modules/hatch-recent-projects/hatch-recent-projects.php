<?php

if (!class_exists('cfct_module_hatch_recent_projects') && class_exists('cfct_build_module')) {
	class cfct_module_hatch_recent_projects extends cfct_build_module {
    private $heading_styles = array(
      'h2' => 'H2 (Heading 2)',
      'h3' => 'H3 (Heading 3)',
      'h4' => 'H4 (Heading 4)'
    );
    private $default_title = 'Our recent projects';

		public function __construct() {
			$opts = array(
				'description' => __('Display a list of recent projects.', 'carrington-build'),
				'icon' => 'hatch-recent-projects/icon.png'
			);
			parent::__construct('cfct-module-hatch-recent-projects', __('.: Hatch Recent Projects :.', 'carrington-build'), $opts);
		}

// Display
		public function display($data) {
			return $this->load_view($data, apply_filters('cbtb_query_recent_projects', array('data'=>$data, 'obj'=>$this, 'default_title'=>$this->default_title)));
		}

		public function admin_form($data) {
			// basic info
      $heading_style = (!empty($data[$this->get_field_name('heading_style')]) ? esc_html($data[$this->get_field_name('heading_style')]) : '');
      $heading_style_options = '';
      foreach($this->heading_styles as $key=>$head_style){
        $heading_style_options .= '<option value="'.$key.'"'.(($key==$heading_style)?' selected=""':'').'>'.$head_style.'</option>';
      }
      $tag = (!empty($data[$this->get_field_name('tag')]) ? esc_html($data[$this->get_field_name('tag')]) : '');
      $tags = get_terms('services', array('hide_empty' => 0));
      $tag_options = '<option value="" '.(($tag=='')?' selected="selected"':'').'>Select project tag</option>';
      foreach($tags as $t) {
        $args = array('post_type' => 'showroom', 'services' => $t->slug, 'post_status' => 'publish', 'posts_per_page' => 4);
        $count_posts = count(get_posts($args));
        $tag_options .= '<option value="'.$t->slug.'"'.(($t->slug==$tag)?' selected="selected"':'').'>'.$t->name.(($count_posts>0)?' ('.(($count_posts>3)?'more than 3':$count_posts).' project'.(($count_posts>1)?'s':'').')':'').'</option>';
      }
			$html = '
				<div id="'.$this->id_base.'-content-info">
					<div id="'.$this->id_base.'-content-fields">
					  <div class="cfct-field">
              <label for="'.$this->get_field_id('title').'">'.__('Title').'</label>
              <input type="text" name="'.$this->get_field_name('title').'" id="'.$this->get_field_id('title').'" value="'.(!empty($data[$this->get_field_name('title')]) ? esc_html($data[$this->get_field_name('title')]) : $this->default_title).'" />
              <p class="help">Eg. Our [green]recent[/] projects</p>
            </div>
					  <div class="cfct-field">
              <label for="'.$this->get_field_id('tag').'">'.__('Project Tag').'</label>
              <div>
                <select id="'.$this->get_field_id('tag').'" name="'.$this->get_field_name('tag').'" class="cfct-style-chooser">'.$tag_options.'</select>
              </div>
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
			$title = null;
			if (!empty($data[$this->get_field_name('title')])) {
				$title = esc_html($data[$this->get_field_name('title')]);
			}
			return substr($title, 0, 25).PHP_EOL;
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

// Content Move Helpers
	}
	cfct_build_register_module('cfct_module_hatch_recent_projects');
}
?>
