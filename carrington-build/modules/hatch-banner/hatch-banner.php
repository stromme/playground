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
      $video = isset($data[$this->get_field_name('video')]) ? esc_html($data[$this->get_field_name('video')]) : '';
      $id = 'banner-'.$data['module_id'];
      $image = '';
      $js_init = '';
      $js_data = array();
      if($banner_type=='static'){
        $image_id = ($data[$this->get_field_id('post_image')]!='')?$data[$this->get_field_id('post_image')]:(($data[$this->get_field_id('global_image')])?$data[$this->get_field_id('global_image')]:'');
        $description = $data[$this->get_field_id('description')];
        $author = $data[$this->get_field_id('author')];
        $author_location = $data[$this->get_field_id('author-location')];
        if (!empty($image_id) && $_img = wp_get_attachment_image_src($image_id, 'banner', false)) {
          $image = $_img[0];
        }
        $js_single_data = new stdClass();
        $js_single_data->id = '';
        $js_single_data->description = parse_embed_video_link(parse_shortclass($description));
        $js_single_data->author = parse_shortclass($author);
        $js_single_data->company = '';
        $js_single_data->author_location = parse_shortclass($author_location);
        $js_single_data->images = array($image);
        $js_single_data->video = $video;
        $js_single_data->term = '';
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
        $page_term = '';
        if($post_type=='page'){
          $posts_args = $args;
          $posts_args['meta_key'] = 'featured';
          $posts_args['orderby'] = 'featured';
          $projects = get_posts($posts_args);

          if(count($projects)<=0){
            $args['order'] = 'DESC';
            $projects = get_posts($args);
          }
        }
        else {
          $posts_args = $args;
          $posts_args['meta_key'] = 'pinned';
          $posts_args['orderby'] = 'pinned';
          if($post_type=='cftl-tax-landing'){
            $posts_args['numberposts'] = -1;
            $services_terms = wp_get_post_terms($post->ID, 'services', array('hide_empty'=>0));
            if($services_terms){
              $page_term = $services_terms[0]->slug;
            }
            else {
              $locations_terms = wp_get_post_terms($post->ID, 'services', array('hide_empty'=>0));
              if($locations_terms){
                $page_term = $locations_terms[0]->slug;
              }
            }
          }
          $projects = get_posts($posts_args);
          if(count($projects)<=0){
            $args['order'] = 'DESC';
            $projects = get_posts($args);
          }
        }

        if(count($projects)>0){
          $i = 0;
          foreach($projects as $project){
            $cust_id = get_post_meta($project->ID, 'customer_id', true);
            $favorite = get_post_meta($project->ID, 'favorite', true);
            $services_terms = wp_get_post_terms($project->ID, 'services', array('hide_empty'=>0));
            $term = '';
            if($services_terms){
              $term = $services_terms[0]->slug;
            }
            else {
              $locations_terms = wp_get_post_terms($project->ID, 'services', array('hide_empty'=>0));
              if($locations_terms){
                $term = $locations_terms[0]->slug;
              }
            }
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
                $_img = wp_get_attachment_image_src($media->ID, 'banner', false);
                array_push($project_media, $_img[0]);
              }
            }
            $private = 0;
            $company = '';
            if($cust_id!=''){
              $contact = get_post($cust_id);
              $first_name = get_post_meta($contact->ID, 'first_name', true);
              $last_name = get_post_meta($contact->ID, 'last_name', true);
              $city = get_post_meta($contact->ID, 'city', true);
              $company = get_post_meta($contact->ID, 'company', true);
              $private = get_post_meta($contact->ID, 'make_private', true);
              $name = ($first_name!='' && $last_name!='')?
                        $first_name.' '.$last_name:
                        (($first_name!='')?
                          $first_name:
                          (($last_name!='')?$last_name:''));
            }
            if($i==0){
              $description = $project->post_content;
              $author = $name;
              $author_location = $city;
              $image = $project_media[0];
            }

            $js_single_data = new stdClass();
            $js_single_data->id = $project->ID;
            $js_single_data->description = parse_shortclass($project->post_content);
            $js_single_data->author = parse_shortclass($name);
            $js_single_data->author_location = parse_shortclass($city);
            $js_single_data->company = parse_shortclass($company);
            $js_single_data->images = $project_media;
            $js_single_data->video = '';
            $js_single_data->term = $term;
            $js_single_data->is_private = ($private==1)?true:false;
            array_push($js_data, $js_single_data);
            $i++;
          }
        }

        if($post_type=='cftl-tax-landing'){
          $new_js_data = array();
          if(count($js_data)>0){
            $counter = 0;
            foreach($js_data as $js_single_data){
              if($js_single_data->term==$page_term){
                array_push($new_js_data, $js_single_data);
                $counter++;
                if($counter>=3) break;
              }
            }
          }
          $js_data = $new_js_data;
        }

        $js_id = 'data_'.str_replace('-','_',$id);
        $js_init = '
        <script type="text/javascript">
          var '.$js_id.' = '.json_encode($js_data).';
          $(document).ready(function(){
            if('.$js_id.'.length>0){
              var carousel = $(".carousel-'.$id.'");
              var current_item_id = 0;
              var current_image_idx = 0;
              var interval = '.$interval.';
              var timeout = setTimeout(function(){
                cycle_image_'.$js_id.'();
              }, interval);
              $(".carousel-indicators li", carousel).mousedown(function(e){
                e.preventDefault();
              }).click(function(){
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
                if('.$js_id.'[current_item_id].images)
                  active_image.attr("src", '.$js_id.'[current_item_id].images[current_image_idx]);
                active_indicators = $(".carousel-indicators li", active_item);
                $(active_indicators[current_item_id]).addClass("active");
                timeout = setTimeout(function(){
                  cycle_image_'.$js_id.'();
                }, interval);
              });
            }
            function cycle_image_'.$js_id.'(){
              clearTimeout(timeout);
              var items = $(".item", carousel);
              var active_item;
              var active_image;
              var banner_photo;
              var new_image;
              var max_width;
              var new_width;
              current_image_idx++;
              if('.$js_id.'.length>1 && '.$js_id.'[current_item_id].images && current_image_idx>='.$js_id.'[current_item_id].images.length){
                current_item_id++;
                current_image_idx = 0;
                if(current_item_id>='.$js_id.'.length){
                  current_item_id = 0;
                }
                active_item = items[current_item_id];
                banner_photo = $(".banner-photo", active_item);
                active_image = $("img", banner_photo);
                banner_photo.append("<img src=\'"+'.$js_id.'[current_item_id].images[current_image_idx]+"\' style=\'position:absolute;left:0;top:0;display:none;\' />");
                new_image = $("img", banner_photo).last();
                new_image.load(function(){
                  active_image.remove();
                  banner_photo.removeAttr("style");
                  new_image.removeAttr("style");
                  active_image.remove();
                  $(active_item).css({"top":0,"position":"absolute","z-index":1});
                  $(active_item).fadeIn("fast", function(){
                    $(active_item).removeAttr("style");
                    carousel.carousel(current_item_id);
                    carousel.carousel("pause");
                    active_indicators = $(".carousel-indicators li", active_item);
                    $(active_indicators[current_item_id]).addClass("active");
                    timeout = setTimeout(function(){
                      cycle_image_'.$js_id.'();
                    }, interval);
                  });
                }).error(function() {
                  banner_photo.removeAttr("style");
                  new_image.remove();
                  timeout = setTimeout(function(){
                    cycle_image_'.$js_id.'();
                  }, interval);
                });
              }
              else if('.$js_id.'[current_item_id].images && '.$js_id.'[current_item_id].images.length>1) {
                active_item = items[current_item_id];
                banner_photo = $(".banner-photo", active_item);
                active_image = $("img", banner_photo);
                banner_photo.append("<img src=\'"+'.$js_id.'[current_item_id].images[current_image_idx]+"\' style=\'position:absolute;left:0;top:0;display:none;\' />");
                new_image = $("img", banner_photo).last();
                new_image.load(function(){
                  active_image.fadeOut("fast");
                  new_image.fadeIn("fast", function(){
                    banner_photo.removeAttr("style");
                    new_image.removeAttr("style");
                    active_image.remove();
                    var width = $(".banner-review", active_item).outerWidth();
                    timeout = setTimeout(function(){
                      cycle_image_'.$js_id.'();
                    }, interval);
                    if('.$js_id.'.length<=1){
                      if(current_image_idx>='.$js_id.'[current_item_id].images.length-1) current_image_idx = -1;
                    }
                  });
                }).error(function() {
                  banner_photo.removeAttr("style");
                  new_image.remove();
                  timeout = setTimeout(function(){
                    cycle_image_'.$js_id.'();
                  }, interval);
                });;
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
              <div>
                <label for="'.$this->get_field_id('video').'">'.__('Video').'</label>
                <input type="text" name="'.$this->get_field_name('video').'" id="'.$this->get_field_id('video').'" value="'.(!empty($data[$this->get_field_name('video')]) ? esc_html($data[$this->get_field_name('video')]) : '').'" />
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