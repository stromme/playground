<?php

if (!class_exists('cfct_module_hatch_banner') && class_exists('cfct_build_module')) {
	class cfct_module_hatch_banner extends cfct_build_module {
		public function __construct() {
			$opts = array(
				'description' => __('Display a Banner', 'carrington-build'),
				'icon' => 'hatch-banner/icon.png'
			);
      parent::__construct('cfct-module-hatch-banner', __('.: Hatch Banner :.', 'carrington-build'), $opts);
		}

// Display
		
		/**
		 * contains capacity to have pre-defined links & image urls,
		 * though that functionality is not exposed in the admin
		 *
		 * @param string $data 
		 * @return void
		 */
		public function display($data) {
      $banner_type = isset($data[$this->get_field_id('type')]) ? $data[$this->get_field_id('type')] : '';
      $interval = isset($data[$this->get_field_id('interval')]) ? intval($data[$this->get_field_id('interval')]) : 4000;
      $id = 'banner-'.$data['module_id'];
      $image = '';
      $js_init = '';
      $js_data = array();
      if($banner_type=='static'){
        $image_id = ($data[$this->get_field_id('post_image')]!='')?$data[$this->get_field_id('post_image')]:(($data[$this->get_field_id('global_image')])?$data[$this->get_field_id('global_image')]:'');
        $description = $data[$this->get_field_id('description')];
        $author = $data[$this->get_field_id('author')];
        $author_location = $data[$this->get_field_id('author-location')];
        if (!empty($image_id) && $_img = wp_get_attachment_image_src($image_id, 'large', false)) {
          $image = $_img[0];
        }
        $js_single_data = new stdClass();
        $js_single_data->description = $description;
        $js_single_data->author = $author;
        $js_single_data->author_location = $author_location;
        $js_single_data->images = array($image);
        array_push($js_data, $js_single_data);
      }
      else {
        global $post;
        $post_type = $post->post_type;
        $args = array(
          'numberposts' => 3,
          'post_type'   => 'showroom',
          'post_status' => 'any',
          'post_parent' => null,
          'order'       => 'ASC'
        );
        if($post_type=='page'){
          $posts_args = $args;
          $posts_args['meta_key'] = 'featured';
          $posts_args['orderby'] = 'featured';
          $projects = get_posts($posts_args);

          if(count($projects)<=0){
            $projects = get_posts($args);
          }
        }
        else {
          $posts_args = $args;
          $posts_args['meta_key'] = 'pinned';
          $posts_args['orderby'] = 'pinned';
          $projects = get_posts($args);
          if(count($projects)<=0){
            $projects = get_posts($args);
          }
        }

        if(count($projects)>0){
          $i = 0;
          foreach($projects as $project){
            $cust_id = get_post_meta($project->ID, 'customer_id', true);
            $favorite = get_post_meta($project->ID, 'favorite', true);
            $name = '';
            $city = '';
            $args = array(
              'numberposts' => -1,
              'post_type' => 'attachment',
              'post_parent' => $project->ID
            );
            $attachments = get_posts($args);
            $args = array(
              'numberposts' => -1,
              'post_type' => 'videos',
              'post_parent' => $project->ID
            );
            $videos = get_posts($args);
            if(count($attachments)>0){
              $medias = $attachments;
              if(count($videos)>0)
                array_merge($medias, $videos);
            }
            else {
              $medias = $videos;
            }
            $selected_medias = array();
            // Add favorite first
            foreach($medias as $media){
              if($media->ID==$favorite){
                array_push($selected_medias, $media);
                break;
              }
            }
            foreach($medias as $media){
              if($media->ID!=$favorite){
                array_push($selected_medias, $media);
              }
            }
            $project_media = array();
            foreach($selected_medias as $media){
              if($media->post_type=='videos'){
                $video_image = get_post_meta($media->ID, 'video_thumbnail', true);
                array_push($project_media, $video_image);
              }
              else {
                $_img = wp_get_attachment_image_src($media->ID, 'large', false);
                array_push($project_media, $_img[0]);
              }
            }
            if($cust_id!=''){
              $contact = get_post($cust_id);
              $first_name = get_post_meta($contact->ID, 'first_name', true);
              $last_name = get_post_meta($contact->ID, 'last_name', true);
              $city = get_post_meta($contact->ID, 'city', true);
              $company = get_post_meta($contact->ID, 'company', true);
              $name = ($company!='')?
                        $company:
                        (($first_name!='' && $last_name!='')?
                          $first_name.' '.$last_name:
                          (($first_name!='')?
                            $first_name:
                            (($last_name!='')?$last_name:'')));
            }
            if($i==0){
              $description = $project->post_content;
              $author = $name;
              $author_location = $city;
              $image = $project_media[0];
            }

            $js_single_data = new stdClass();
            $js_single_data->description = $project->post_content;
            $js_single_data->author = $name;
            $js_single_data->author_location = $city;
            $js_single_data->images = $project_media;
            array_push($js_data, $js_single_data);
            $i++;
          }
        }
        $js_id = 'data_'.str_replace('-','_',$id);
        $js_init = '
        <script type="text/javascript">
          var '.$js_id.' = '.json_encode($js_data).';
          $(document).ready(function(){
            var carousel = $(".carousel-'.$id.'");
            $(".write-review").unbind("click");
            $(".write-review").click(function(e){
              e.preventDefault();
              $("#new-review").modal();
            });
            var current_item_id = 0;
            var current_image_idx = 0;
            var interval = '.$interval.';
            var timeout = setTimeout(function(){
              cycle_image();
            }, interval);
            $(".carousel-indicators li", carousel).click(function(){
              clearTimeout(timeout);
              current_item_id = parseInt($(this).attr("data-slide-to"));
              current_image_idx = 0;
              carousel.carousel(current_item_id);
              setTimeout(function(){
                carousel.carousel("pause");
              });
              var items = $(".item", carousel);
              items.removeAttr("style");
              var active_item = items[current_item_id];
              active_image = $(".banner-photo img", active_item);
              active_image.attr("src", '.$js_id.'[current_item_id].images[current_image_idx]);
              active_indicators = $(".carousel-indicators li", active_item);
              $(active_indicators[current_item_id]).addClass("active");
              timeout = setTimeout(function(){
                cycle_image();
              }, interval);
            });
            function cycle_image(){
              clearTimeout(timeout);
              var items = $(".item", carousel);
              var active_item;
              var active_image;
              current_image_idx++;
              if(current_image_idx>='.$js_id.'[current_item_id].images.length){
                current_item_id++;
                current_image_idx = 0;
                if(current_item_id>='.$js_id.'.length){
                  current_item_id = 0;
                }
                active_item = items[current_item_id];
                active_image = $(".banner-photo img", active_item);
                active_image.attr("src", '.$js_id.'[current_item_id].images[current_image_idx]);
                $(active_item).css({"top":0,"position":"absolute","z-index":1});
                $(active_item).fadeIn("fast", function(){
                  $(active_item).removeAttr("style");
                  carousel.carousel(current_item_id);
                  carousel.carousel("pause");
                  active_indicators = $(".carousel-indicators li", active_item);
                  $(active_indicators[current_item_id]).addClass("active");
                  timeout = setTimeout(function(){
                    cycle_image();
                  }, interval);
                });
              }
              else {
                active_item = items[current_item_id];
                active_image = $(".banner-photo img", active_item);
                active_image.fadeOut("fast", function(){
                  active_image.attr("src", '.$js_id.'[current_item_id].images[current_image_idx]);
                  active_image.fadeIn("fast", function(){
                    var width = $(".banner-review", active_item).outerWidth();
                    timeout = setTimeout(function(){
                      cycle_image();
                    }, interval);
                  });
                });
              }
            }
          });
        </script>';
      }
			return $this->load_view($data, compact('id','js_data','js_init'));
		}
		
// Admin

		public function text($data) {
      $banner_type = isset($data[$this->get_field_id('type')]) ? $data[$this->get_field_id('type')] : '';
			return ($banner_type=='smart')?'Smart banner':'Static banner';
		}

		public function admin_form($data) {
      $banner_types = apply_filters(
        'cfct-module-hatch-banner-types',
        array(
          'smart' => 'Smart Banner',
          'static' => 'Static Banner',
        )
      );
      $banner_type = isset($data[$this->get_field_id('type')]) ? $data[$this->get_field_id('type')] : '';
      $banner_type_selection = '';
      foreach ($banner_types as $val => $text) {
        $banner_type_selection .= '
          <option value="'.esc_attr($val).'" '.selected($val, $banner_type, false).'>'.esc_html($text).'</option>
        ';
      }
			// basic info
			$html = '
				<!-- basic info -->
				<div id="'.$this->id_base.'-content-info">

					<!-- inputs -->
					<div id="'.$this->id_base.'-content-fields">
            <div>
              <label for="'.$this->get_field_id('type').'">'.__('Banner Type').'</label>
              <select name="'.$this->get_field_name('type').'" id="'.$this->get_field_id('type').'">'.
              $banner_type_selection.'
              </select>
            </div>
            <div id="'.$this->id_base.'-carousel-interval" style="'.(($banner_type=='static')?'display:none;':'display:block;').'">
              <label for="'.$this->get_field_id('interval').'">'.__('Carousel interval (milliseconds)').'</label>
              <div>
                <input type="text" name="'.$this->get_field_name('interval').'" id="'.$this->get_field_id('interval').'" value="'.(!empty($data[$this->get_field_name('interval')]) ? esc_html($data[$this->get_field_name('interval')]) : '4000').'" class="width-small" />
              </div>
            </div>
            <div id="'.$this->id_base.'-static-fields" style="'.(($banner_type=='static')?'display:block;':'display:none;').'">
              <div>
                <label for="'.$this->get_field_id('description').'">'.__('Description').'</label>
                <textarea name="'.$this->get_field_name('description').'" id="'.$this->get_field_id('description').'">'.(!empty($data[$this->get_field_name('description')]) ? esc_html($data[$this->get_field_name('description')]) : '').'</textarea>
              </div>
              <div>
                <label for="'.$this->get_field_id('author').'">'.__('Author').'</label>
                <input type="text" name="'.$this->get_field_name('author').'" id="'.$this->get_field_id('author').'" value="'.(!empty($data[$this->get_field_name('author')]) ? esc_html($data[$this->get_field_name('author')]) : '').'" />
              </div>
              <div>
                <label for="'.$this->get_field_id('author-location').'">'.__('Author Location').'</label>
                <input type="text" name="'.$this->get_field_name('author-location').'" id="'.$this->get_field_id('author-location').'" value="'.(!empty($data[$this->get_field_name('author-location')]) ? esc_html($data[$this->get_field_name('author-location')]) : '').'" />
              </div>
            </div>
          </div>
          <!-- /inputs -->
        </div>
        <!-- / basic info -->
        <div class="clear"></div>
      ';

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
        <div id="'.$this->id_base.'-image-selectors" style="'.(($banner_type=='static')?'display:block;':'display:none;').'">
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
        <!-- / image selector tabs -->
      ';

			return $html;
		}
		
		public function update($new, $old) {
			return $new;
		}
		
		public function css() {
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
          margin-top: 15px;
        }
      ';
		}
		
		/**
		 * Admin JS functionality
		 *
		 * @uses o-type-ahead.js
		 * @return string
		 */
		public function admin_js() {
      $js = '
        cfct_builder.addModuleLoadCallback("'.$this->id_base.'", function() {
          '.$this->cfct_module_tabs_js().'
          $("#'.$this->get_field_id('type').'").change(function(){
            var fields = $("#'.$this->id_base.'-static-fields");
            var image_field = $("#'.$this->id_base.'-image-selectors");
            var carousel_field = $("#'.$this->id_base.'-carousel-interval");

            if($(this).val()=="static"){
              fields.slideDown("fast");
              image_field.slideDown("fast");
              carousel_field.slideUp("fast");
            }
            else {
              fields.slideUp("fast");
              image_field.slideUp("fast");
              carousel_field.slideDown("fast");
            }
          });
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
		
		public function js() {
			return '
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

      $args = array(
        'field_name' => 'post_image',
        'selected_image' => $selected,
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

      $args = array(
        'field_name' => 'global_image',
        'selected_image' => $selected,
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
	cfct_build_register_module('cfct_module_hatch_banner');
}
?>