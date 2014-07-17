<?php

if (!class_exists('cfct_module_hatch_featurette_v2') && class_exists('cfct_build_module')) {
	class cfct_module_hatch_featurette_v2 extends cfct_build_module {
    private $image_styles = array(
      'left' => 'Image Left',
      'right' => 'Image Right',
      'top' => 'Image Top',
      'bottom' => 'Image Bottom'
    );
    private $image_sizes = array(
      'auto' => 'Auto',
      'small' => 'Small',
      'medium' => 'Medium',
      'large' => 'Large (Half Window)',
      'xlarge' => 'Extra Large',
      'fixed-100' => 'Fixed 100px',
      'fixed-50' => 'Fixed 50px'
    );
    private $image_size_classes = array(
      'small' => array(
        'photo' => 'col-sm-3 col-md-3 col-lg-3',
        'photo_push' => 'col-sm-push-9 col-md-push-9 col-lg-push-9',
        'text' => 'col-sm-9 col-md-9 col-lg-9',
        'text_pull' => 'col-sm-pull-3 col-md-pull-3 col-lg-pull-3'
      ),
      'medium' => array(
        'photo' => 'col-sm-5 col-md-5 col-lg-5',
        'photo_push' => 'col-sm-push-7 col-md-push-7 col-lg-push-7',
        'text' => 'col-sm-7 col-md-7 col-lg-7',
        'text_pull' => 'col-sm-pull-5 col-md-pull-5 col-lg-pull-5',
      ),
      'large' => array(
        'photo' => 'col-sm-6 col-md-6 col-lg-6',
        'photo_push' => 'col-sm-push-6 col-md-push-6 col-lg-push-6',
        'text' => 'col-sm-6 col-md-6 col-lg-6',
        'text_pull' => 'col-sm-pull-6 col-md-pull-6 col-lg-pull-6',
      ),
      'xlarge' => array(
        'photo' => 'col-sm-8 col-md-8 col-lg-8',
        'photo_push' => 'col-sm-push-4 col-md-push-4 col-lg-push-4',
        'text' => 'col-sm-4 col-md-4 col-lg-4',
        'text_pull' => 'col-sm-pull-4 col-md-pull-8 col-lg-pull-8',
      )
    );
    private $border_style = array(
      '' => 'No border',
      'light-rounded' => 'Light Rounded',
      'img-polaroid' => 'Polaroid'
    );
    private $default_image_size = 'large';
    private $default_image_position = 'left';
    private $default_border_style = '';

		public function __construct() {
			$opts = array(
				'description' => __('Display a headline, (optional) image and brief text with a link.', 'carrington-build'),
				'icon' => 'hatch-featurette-v2/icon.png'
			);
			parent::__construct('cfct-module-hatch-featurette-v2', __('.: Featurette v2 :.', 'carrington-build'), $opts);

      add_action('admin_footer', array($this, 'admin_footer'), 1);
		}

// Display
		public function display($data) {
      $content = isset($data[$this->get_field_id('content')]) ? $data[$this->get_field_id('content')] : '';
      $content = str_replace("\n", "<br />", $content);
      $content = parse_embed_video_link(parse_shortclass($content));
      $video = isset($data[$this->get_field_name('video')]) ? esc_html($data[$this->get_field_name('video')]) : '';
      $image_id = ($data[$this->get_field_id('post_image')]!='')?$data[$this->get_field_id('post_image')]:(($data[$this->get_field_id('global_image')])?$data[$this->get_field_id('global_image')]:'');
      $image = '';
      if (!empty($image_id) && $_img = wp_get_attachment_image_src($image_id, 'large', false)) {
        $image = $_img[0];
      }
      $style = isset($data[$this->get_field_id('style')]) ? $data[$this->get_field_id('style')] : $this->default_image_position;
      $image_size = (!empty($data[$this->get_field_name('image_size')]) ? esc_html($data[$this->get_field_name('image_size')]) : $this->default_image_size);
      $border_style = (!empty($data[$this->get_field_name('border_style')]) ? esc_html($data[$this->get_field_name('border_style')]) : $this->default_border_style);
      $image_size_classes = (!empty($this->image_size_classes[$image_size]))?$this->image_size_classes[$image_size]:(($image_size=='auto')?$this->image_size_classes['large']:'');
      if($image_size_classes!=''){
        $photo_classes = $image_size_classes['photo'];
        $text_classes = $image_size_classes['text'];
        if($style=='right'){
          $photo_push_classes = $image_size_classes['photo_push'];
          $text_pull_classes = $image_size_classes['text_pull'];
        }
      }
      else {
        $photo_classes = $text_classes = $photo_push_classes = $text_pull_classes = '';
      }
      $this->view = 'view-'.$style.'.php';
			return $this->load_view($data, compact('content', 'video', 'image', 'image_size', 'photo_classes', 'text_classes', 'photo_push_classes', 'text_pull_classes', 'border_style'));
		}

		public function admin_form($data) {
			// basic info
      $style = (!empty($data[$this->get_field_name('style')]) ? esc_html($data[$this->get_field_name('style')]) : '');
      $image_style_options = '';
      foreach($this->image_styles as $key=>$img_style){
        $image_style_options .= '<option value="'.$key.'"'.(($key==$style)?' selected=""':'').'>'.$img_style.'</option>';
      }
      $image_size = (!empty($data[$this->get_field_name('image_size')]) ? esc_html($data[$this->get_field_name('image_size')]) : '');
      if($image_size=='') $image_size = 'middle6';
      $image_size_options = '';
      foreach($this->image_sizes as $key=>$size){
        $image_size_options .= '<option value="'.$key.'"'.(($key==$image_size)?' selected=""':'').'>'.$size.'</option>';
      }
      $border_style = (!empty($data[$this->get_field_name('border_style')]) ? esc_html($data[$this->get_field_name('border_style')]) : $this->default_border_style);
      $border_style_options = '';
      foreach($this->border_style as $key=>$img_border){
        $border_style_options .= '<option value="'.$key.'"'.(($key==$border_style)?' selected=""':'').'>'.$img_border.'</option>';
      }
      $content = (isset($data[$this->get_field_name('content')]) ? $data[$this->get_field_name('content')] : '');
      ob_start();
      wp_editor($content, $this->get_field_id('content'), array(
        'first_init' => false,
        'media_buttons' => true,
        'textarea_name' => $this->get_field_name('content')
      ));
      $ret = ob_get_clean();
			$html = '
				<div id="'.$this->id_base.'-content-info">
			    '.$ret.'
				</div>
				<div id="'.$this->id_base.'-content-info">
				  <div id="'.$this->id_base.'-content-left">
            <div class="cfct-field">
              <label for="'.$this->get_field_id('style').'">Style</label>
              <select id="'.$this->get_field_id('style').'" name="'.$this->get_field_name('style').'" class="cfct-style-chooser">'.$image_style_options.'</select>
              <div class="clear"></div>
            </div>
            <div class="cfct-field">
              <label for="'.$this->get_field_id('image_size').'">Image size</label>
              <select id="'.$this->get_field_id('image_size').'" name="'.$this->get_field_name('image_size').'">'.$image_size_options.'</select>
              <div class="clear"></div>
            </div>
					</div>
          <div id="'.$this->id_base.'-content-right">
            <div class="cfct-field">
              <label for="'.$this->get_field_id('border_style').'">Border style</label>
              <select id="'.$this->get_field_id('border_style').'" name="'.$this->get_field_name('border_style').'">'.$border_style_options.'</select>
              <div class="clear"></div>
            </div>
            <div class="cfct-field">
              <label for="'.$this->get_field_id('video').'">'.__('Video').'</label>
              <input type="text" name="'.$this->get_field_name('video').'" id="'.$this->get_field_id('video').'" value="'.(!empty($data[$this->get_field_name('video')]) ? esc_html($data[$this->get_field_name('video')]) : '').'" />
              <div class="clear"></div>
            </div>
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
      $style = isset($data[$this->get_field_id('style')]) ? $data[$this->get_field_id('style')] : 'left';
      $style_name = $this->image_styles[$style].': ';
			$title = null;
			if (!empty($data[$this->get_field_name('content')])) {
				$title = esc_html(strip_tags($data[$this->get_field_name('content')]));
			}
			return $style_name.$title.PHP_EOL;
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
          (function() {
            var init, edId, qtId, firstInit, wrapper;
            if ( typeof tinymce !== "undefined" ) {
              edId = "'.$this->get_field_id('content').'";
              if ( firstInit ) {
                init = tinyMCEPreInit.mceInit[edId] = tinymce.extend( {}, firstInit, tinyMCEPreInit.mceInit[edId] );
              } else {
                init = firstInit = tinyMCEPreInit.mceInit[edId];
              }

              wrapper = tinymce.DOM.select( "#wp-" + edId + "-wrap" )[0];

              if ( ( tinymce.DOM.hasClass( wrapper, "tmce-active" ) || ! tinyMCEPreInit.qtInit.hasOwnProperty( edId ) ) &&
                ! init.wp_skip_init ) {

                try {
                  init["plugins"]+=",checkedlist";
                  init["formats"]["p_lead"] = {block : \'p\', attributes: { class: \'lead\'}};
                  init["formats"]["p_small"] = {block : \'p\', attributes: { class: \'small\'}};
                  init["block_formats"] = "Paragraph=p;P Lead=p_lead;P Small=p_small;Pre=pre;Heading 1=h1;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 5=h5";
                  tinymce.init( init );

                  if ( ! window.wpActiveEditor ) {
                    window.wpActiveEditor = edId;
                  }
                } catch(e){}
              }
            }

            var qtId = "'.$this->get_field_id('content').'";
            if ( typeof quicktags !== "undefined" ) {
              try {
                var qtInit = {id: qtId, buttons: "strong,em,link,block,del,ins,img,ul,ol,li,code,close,fullscreen"}
                if(typeof(QTags.instances)=="object" && QTags.instances[0]!==undefined){
                  delete(QTags.instances[0]);
                }
                var qt = quicktags(qtInit);
              } catch(e){};
            }

            if ( typeof jQuery !== "undefined" ) {
              jQuery(".wp-editor-wrap").on( "click.wp-editor", function() {
                if ( this.id ) {
                  window.wpActiveEditor = this.id.slice( 3, -5 );
                }
              });
            } else {
              document.getElementById( "wp-" + qtId + "-wrap" ).onclick = function() {
                window.wpActiveEditor = this.id.slice( 3, -5 );
              }
            }
          }());

					// properly destroy the editor on cancel
					$("#cfct-edit-module-cancel").click(function() {
						var _ed = tinymce.get("'.$this->get_field_id('content').'");
						tinymce.remove(_ed);
					});

					var wrap = $("#wp-'.$this->get_field_id('content').'-wrap");
          if(wrap.hasClass("html-active")){
            wrap.removeClass("html-active").addClass("tmce-active");
          }

					'.$this->cfct_module_tabs_js().'
				});
				
				cfct_builder.addModuleSaveCallback("'.$this->id_base.'", function() {
				  var textarea_elm = $("#'.$this->get_field_id('content').'");
			    var textarea_content = textarea_elm.val();
					var _ed = tinymce.get("'.$this->get_field_id('content').'");
					_ed.save();
					tinymce.remove(_ed);
					var wrap = $("#wp-'.$this->get_field_id('content').'-wrap");
					if(wrap.hasClass("html-active")){
            textarea_elm.val(textarea_content);
          }
          else {
            textarea_elm.css({color:"#333"});
            wrap.removeClass("tmce-active").addClass("html-active");
          }

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
				#'.$this->get_field_id('content').' {
					height: 260px;
				}
				#cfct-hatch-featurette-v2-content_tbl {
					background-color: #fff;
				}
				#cfct-hatch-featurette-v2-edit-form .wp-editor-tabs {
					//display: none;
				}
				#cfct-hatch-featurette-v2-edit-form .wp-media-buttons .button {
					margin: 2px 0 0 2px;
				}
				#cfct-hatch-featurette-v2-edit-form .cfct-popup-content {
					overflow: visible !important;
					max-height: none !important;
				}
				#'.$this->id_base.'-edit-form i.mce-i-checkedlist:before {
				  content: \'✔\';
				}
				#'.$this->id_base.'-content-left {
					width: 49%;
					float: left;
					margin-right: 2%;
				}
				#'.$this->id_base.'-content-right {
          width: 49%;
          float: left;
        }
				#'.$this->id_base.'-content-info label {
					width: 100px;
					float: left;
					line-height: 30px;
				}
				#'.$this->id_base.'-image-selectors div#'.$this->id_base.'-image-selector-tabs {
					margin-top: 0;
				}
				#'.$this->id_base.'-content-info .cfct-field {
				  margin: 5px 0;
				}
				#'.$this->id_base.'-content-info input[type="text"],
				#'.$this->id_base.'-content-info select {
          float: left;
          max-width: 100%;
          min-width: 250px;
          width: auto;
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

    public function admin_footer() {
      if(!is_network_admin() && isset($_GET['post'])){
        $set = _WP_Editors::parse_settings($this->get_field_id('content'), array(
          'dfw' => true,
          'editor_height' => 200,
          'editor_css' => true,
          'tinymce' => array(
            'resize' => false,
            'add_unload_trigger' => false,
            'toolbar1' => "bold,italic,strikethrough,bullist,numlist,checkedlist,blockquote,hr,alignleft,aligncenter,alignright,link,unlink,code,spellchecker,wp_adv,wp_fullscreen",
            'toolbar2' => "formatselect,underline,alignjustify,forecolor,removeformat,charmap,outdent,indent,undo,redo,wp_help",
            'toolbar3' => "",
            'toolbar4' => ""
          ),
          'quicktags' => false
        ));
        _WP_Editors::editor_settings($this->get_field_id('content'), $set);
        wp_enqueue_script( 'tinymce-checklist', trailingslashit( TOOLBOX_JS ).'tinymce-checklist.js', array(), false, true);
      }
    }
	}
	cfct_build_register_module('cfct_module_hatch_featurette_v2');
}
?>
