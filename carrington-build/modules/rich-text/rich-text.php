<?php

/**
 * Plain Text Carrington Build Module
 * Simple plain text box that stores and displays exactly what it is given.
 * Good for displaying raw HTML and/or JavaScript
 */
if (!class_exists('cfct_module_rich_text')) {
	class cfct_module_rich_text extends cfct_build_module {
		protected $_deprecated_id = 'cfct-rich-text-module'; // deprecated property, not needed for new module development

		// remove padding from the popup-content form
		protected $admin_form_fullscreen = true;

		public function __construct() {
			$opts = array(
				'description' => __('Provides a WYSIWYG editor.', 'carrington-build'),
				'icon' => 'rich-text/icon.png'
			);
			parent::__construct('cfct-rich-text', __('Rich Text', 'carrington-build'), $opts);

			add_action('admin_footer', array($this, 'admin_footer'), 1);
		}

		public function display($data) {
			$text = do_shortcode($data[$this->get_field_id('content')]);
			return $this->load_view($data, compact('text'));
		}

		public function admin_form($data) {
			$content = (isset($data[$this->get_field_name('content')]) ? $data[$this->get_field_name('content')] : '');
			ob_start();
			wp_editor($content, $this->get_field_id('content'), array(
				'media_buttons' => true,
				'textarea_name' => $this->get_field_name('content'),
			));
			$ret = ob_get_clean();
			return $ret;
		}

		/**
		 * Return a textual representation of this module.
		 *
		 * @param array $data
		 * @return string
		 */
		public function text($data) {
			return strip_tags($data[$this->get_field_name('content')]);
		}


		/**
		 * Modify the data before it is saved, or not
		 *
		 * @param array $new_data
		 * @param array $old_data
		 * @return array
		 */
		public function update($new_data, $old_data) {
			return $new_data;
		}

		/**
		 * Add some admin CSS for formatting
		 *
		 * @return void
		 */
		public function admin_css() {
			return '
				#'.$this->get_field_id('content').' {
					height: 300px;
				}
				#cfct-rich-text-content_tbl {
					background-color: #fff;
				}
				#cfct-rich-text-edit-form .wp-editor-tabs {
					//display: none;
				}
				#cfct-rich-text-edit-form .wp-media-buttons .button {
					margin: 2px 0 0 2px;
				}
				#cfct-rich-text-edit-form .cfct-popup-content {
					overflow: visible !important;
					max-height: none !important;
				}
			';
		}

		public function admin_js() {
			$js = '
				// automatically set focus on the rich text editor
				cfct_builder.addModuleLoadCallback("'.$this->id_base.'",function(form) {
					tinymce.init({
						selector: "#'.$this->get_field_id('content').'",
						menubar: false,
            theme:"modern",
            skin:"lightgray",
            language:"en",
            formats:{
              alignleft: [
                {selector: "p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li", styles: {textAlign:"left"}},
                {selector: "img,table,dl.wp-caption", classes: "alignleft"}
              ],
              aligncenter: [
                {selector: "p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li", styles: {textAlign:"center"}},
                {selector: "img,table,dl.wp-caption", classes: "aligncenter"}
              ],
              alignright: [
                {selector: "p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li", styles: {textAlign:"right"}},
                {selector: "img,table,dl.wp-caption", classes: "alignright"}
              ],
              strikethrough: {inline: "del"}
            },
            relative_urls:false,
            remove_script_host:false,
            convert_urls:false,
            browser_spellcheck:true,
            fix_list_elements:true,
            entities:"38,amp,60,lt,62,gt",
            entity_encoding:"raw",
            keep_styles:false,paste_webkit_styles:"font-weight font-style color",
            preview_styles:"font-family font-size font-weight font-style text-decoration text-transform",
            wpeditimage_disable_captions:false,
            wpeditimage_html5_captions:false,
            plugins:"charmap,hr,media,paste,tabfocus,textcolor,fullscreen,wordpress,wpeditimage,wpgallery,wplink,wpdialogs,wpview,wpfullscreen",
            content_css:"'.get_home_url().'/wp-includes/css/dashicons.min.css?ver=3.9.1,'.get_home_url().'/wp-includes/js/mediaelement/mediaelementplayer.min.css?ver=3.9.1,'.get_home_url().'/wp-includes/js/mediaelement/wp-mediaelement.css?ver=3.9.1,'.get_home_url().'/wp-includes/js/tinymce/skins/wordpress/wp-content.css?ver=3.9.1",
            wpautop:true,indent:false,
            toolbar1:"bold,italic,strikethrough,bullist,numlist,blockquote,hr,alignleft,aligncenter,alignright,link,unlink,spellchecker,wp_fullscreen,wp_adv,code",
            toolbar2:"formatselect,underline,alignjustify,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo",
            toolbar3:"",toolbar4:"",
            tabfocus_elements:"cfct-rich-text-content-tmce",
            body_class:"content post-type-page post-status-auto-draft",add_unload_trigger:false
					});
					try {
            quicktags({
              id:"'.$this->get_field_id('content').'",
              buttons:"strong,em,link,block,del,ins,img,ul,ol,li,code,more,close,fullscreen"
            });
          } catch(e){};
					setTimeout(function() {
					  tinyMCE.execCommand("mceFocus", true, "'.$this->get_field_id('content').'");
					  $("#wp-'.$this->get_field_id('content').'-wrap").removeClass("html-active").addClass("tmce-active");
          }, 10);

					// properly destroy the editor on cancel
					$("#cfct-edit-module-cancel").click(function() {
						var _ed = tinyMCE.get("'.$this->get_field_id('content').'");
						tinyMCE.remove(_ed);
					});
				});

				// we have to register a save callback so that tinyMCE pushes the data
				// back to the original textarea before the submit script gathers its content
				cfct_builder.addModuleSaveCallback("'.$this->id_base.'",function(form) {
				  var textarea_elm = $("#'.$this->get_field_id('content').'");
			    var textarea_content = textarea_elm.val();
					var _ed = tinyMCE.get("'.$this->get_field_id('content').'");
					_ed.save();
					tinyMCE.remove(_ed);
					var wrap = $("#wp-'.$this->get_field_id('content').'-wrap");
					if(wrap.hasClass("html-active")){
            textarea_elm.val(textarea_content);
          }
          else {
            textarea_elm.css({color:"#333"});
            wrap.removeClass("tmce-active").addClass("html-active");
          }
				});
			';
			return $js;
		}

		public function admin_footer() {
      if(!is_network_admin() && isset($_GET['post'])){
        $set = _WP_Editors::parse_settings($this->get_field_id('content'), array(
          'dfw' => true,
          'editor_height' => 300,
          'editor_css' => true,
          'tinymce' => array(
            'resize' => false,
            'add_unload_trigger' => false,
          )
        ));
        _WP_Editors::editor_settings($this->get_field_id('content'), $set);
      }
		}
	}

	cfct_build_register_module('cfct_module_rich_text');
}
?>
