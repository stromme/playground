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
        'first_init' => false,
				'media_buttons' => true,
				'textarea_name' => $this->get_field_name('content')
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
				#cfct-rich-text-edit-form i.mce-i-checkedlist:before {
				  content: \'✔\';
				}
			';
		}

		public function admin_js() {
			$js = '
				// automatically set focus on the rich text editor
				cfct_builder.addModuleLoadCallback("'.$this->id_base.'",function(form) {
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
                  init["block_formats"] = "P Lead=p_lead;P Small=p_small;Pre=pre;Heading 1=h1;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 5=h5";
                  tinymce.init( init );

                  if ( ! window.wpActiveEditor ) {
                    window.wpActiveEditor = edId;
                  }
                } catch(e){}
              }

              setTimeout(function(){
                switchEditors.switchto(document.getElementById("cfct-rich-text-content-tmce"));
              }, 300);
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
				});

				// we have to register a save callback so that tinymce pushes the data
				// back to the original textarea before the submit script gathers its content
				cfct_builder.addModuleSaveCallback("'.$this->id_base.'",function(form) {
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

	cfct_build_register_module('cfct_module_rich_text');
}
?>
