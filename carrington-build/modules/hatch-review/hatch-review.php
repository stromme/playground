<?php

if (!class_exists('cfct_module_hatch_review') && class_exists('cfct_build_module')) {
	class cfct_module_hatch_review extends cfct_build_module {
    private $types = array(
      'featured' => 'Show all featured reviews',
      'select' => 'Select reviews to display',
      'manual' => 'Manually enter review'
    );
    private $default_type = 'featured';
    private $pinned_reviews = array();
    private $featured_reviews = array();

		public function __construct() {
			$opts = array(
				'description' => __('Display reviews.', 'carrington-build'),
				'icon' => 'hatch-review/icon.png'
			);
			parent::__construct('cfct-module-hatch-review', __('.: Hatch Review :.', 'carrington-build'), $opts);
      $this->image_path = TOOLBOX_IMAGES.'/raty/';
      // Get all featured reviews
      $args = array(
        'number'  => 3,
        'post_id' => 0,
        'meta_query' => array(
          'relation' => 'AND',
          array(
            'key' => 'featured',
            'value' => '',
            'type' => 'char',
            'compare' => '!='
          )
        )
      );
      $comments = get_comments($args);
      $this->featured_reviews = array();
      foreach($comments as $comment){
        $listed_comment = new stdClass();
        $listed_comment->id = $comment->comment_ID;
        $listed_comment->name = $comment->comment_author;
        $listed_comment->content = $comment->comment_content;
        $listed_comment->company = get_comment_meta($comment->comment_ID, 'company', true);
        $listed_comment->featured = get_comment_meta($comment->comment_ID, 'featured', true);
        $listed_comment->rating = get_comment_meta($comment->comment_ID, 'rating', true);
        array_push($this->featured_reviews, $listed_comment);
      }
      // Sort by featured
      if(count($this->featured_reviews)>1){
        if(!function_exists('featuresort')){
          function featuresort($a,$b) {
            return $a->featured<$b->featured;
          }
        }
        uasort($this->featured_reviews, "featuresort");
      }

      // Get all pinned reviews
      $args = array(
        'number'  => 3,
        'post_id' => 0,
        'meta_query' => array(
          'relation' => 'AND',
          array(
            'key' => 'pinned',
            'value' => '',
            'type' => 'char',
            'compare' => '!='
          )
        )
      );
      $comments = get_comments($args);
      $this->pinned_reviews = array();
      foreach($comments as $comment){
        $listed_comment = new stdClass();
        $listed_comment->id = $comment->comment_ID;
        $listed_comment->name = $comment->comment_author;
        $listed_comment->content = $comment->comment_content;
        $listed_comment->company = get_comment_meta($comment->comment_ID, 'company', true);
        $listed_comment->pinned = get_comment_meta($comment->comment_ID, 'pinned', true);
        $listed_comment->rating = get_comment_meta($comment->comment_ID, 'rating', true);
        array_push($this->pinned_reviews, $listed_comment);
      }
      // Sort by pinned
      if(count($this->pinned_reviews)>1){
        if(!function_exists('pinsort')){
          function pinsort($a,$b) {
            return $a->pinned<$b->pinned;
          }
        }
        uasort($this->pinned_reviews, "pinsort");
      }
		}

// Display
		public function display($data) {
      $id = 'review-'.$data['module_id'];

      $rating = (!empty($data[$this->get_field_name('rating')]) ? esc_html($data[$this->get_field_name('rating')]) : '');
      if($rating=='') $rating = 5;
      $content = (!empty($data[$this->get_field_name('content')]) ? esc_html($data[$this->get_field_name('content')]) : '');
      $name = (!empty($data[$this->get_field_name('name')]) ? esc_html($data[$this->get_field_name('name')]) : '');
      $location = (!empty($data[$this->get_field_name('location')]) ? esc_html($data[$this->get_field_name('location')]) : '');

      $review_id = isset($data[$this->get_field_name('review_id')]) ? $data[$this->get_field_name('review_id')] : '';
      if($review_id=='') $review_id = array();

      $type = (!empty($data[$this->get_field_name('type')]) ? esc_html($data[$this->get_field_name('type')]) : '');
      if($type=='') $type = $this->default_type;

      if($type=='manual'){
        $manual_review = new stdClass();
        $manual_review->id = '';
        $manual_review->name = $name;
        $manual_review->content = $content;
        $manual_review->location = $location;
        $manual_review->rating = $content;
        $reviews = array(
          $manual_review
        );
      }
      else if($type=='select'){
        $reviews = array();
        foreach($review_id as $current_review){
          $found_review = '';
          foreach($this->featured_reviews as $f){
            if($f->id==$current_review){
              $found_review = $f;
              break;
            }
          }
          if($found_review==''){
            foreach($this->pinned_reviews as $p){
              if($p->id==$current_review){
                $found_review = $p;
                break;
              }
            }
          }
          array_push($reviews, $found_review);
        }
      }
      else {
        $reviews = $this->featured_reviews;
      }

      $interval = isset($data[$this->get_field_id('interval')]) ? intval($data[$this->get_field_id('interval')]) : 4000;

      $js_init = '';
      if(($type=="featured" && count($this->featured_reviews)>1) || ($type=="select" && count($review_id)>1)){
        $js_init = '
        <script type="text/javascript">
          $(document).ready(function(){
            var carousel = $(".carousel-'.$id.'");
            carousel.carousel({
              interval: '.$interval.'
            });
            carousel.bind("slide", function(){
              $(".item", $(this)).animate({"opacity":0}, 250, function(){
                var items = $(this);
                setTimeout(function(){
                  items.animate({"opacity":1}, 200);
                }, 200);
              });
            });
          });
        </script>';
      }
			return $this->load_view($data, compact('id', 'type', 'reviews', 'js_init'));
		}

		public function admin_form($data) {
			// basic info
      $type = (!empty($data[$this->get_field_name('type')]) ? esc_html($data[$this->get_field_name('type')]) : '');
      if($type=='') $type = $this->default_type;

      $rating = (!empty($data[$this->get_field_name('rating')]) ? esc_html($data[$this->get_field_name('rating')]) : '');
      if($rating=='') $rating = 5;

      $review_id = isset($data[$this->get_field_name('review_id')]) ? $data[$this->get_field_name('review_id')] : '';
      if($review_id=='') $review_id = array();

      $type_options = '';
      foreach($this->types as $key=>$current_type){
        $type_options .= '<option value="'.$key.'"'.(($key==$type)?' selected=""':'').'>'.$current_type.'</option>';
      }

			$html = '
				<div id="'.$this->id_base.'-content-info">
					<div id="'.$this->id_base.'-content-fields">
						<div class="cfct-field">
							<label for="'.$this->get_field_id('type').'">'.__('Review type').'</label>
							<select name="'.$this->get_field_name('type').'" id="'.$this->get_field_id('type').'">'.$type_options.'</select>
						</div>';

          $html .= '
            <div id="'.$this->get_field_id('review_id').'_selector" '.(($type!='select')?' style="display:none;"':'').'>
              <div class="cfct-field">&nbsp;</div>
              <div class="cfct-field no-space">
                <label>Select reviews</label>
              </div>
              <div class="cfct-field">
                <ul class="cfct-review-list">';
                $featured_review_keys = array();
                foreach($this->featured_reviews as $review){
                  array_push($featured_review_keys, $review->id);
                  $selected = false;
                  if(isset($review_id) && count($review_id>0)){
                    $selected = in_array($review->id, $review_id);
                  }
                  $html .= '
                  <li'.(($selected)?' class="selected"':'').'>
                    <div class="cfct-review-checkbox"><input type="checkbox" value="'.$review->id.'" id="'.$this->get_field_id('review_id').'_'.$review->id.'" name="'.$this->get_field_id('review_id').'[]" '.(($selected)?'checked="checked"':'').'/></div>
                    <label for="'.$this->get_field_id('review_id').'_'.$review->id.'" class="cfct-review-detail">
                      <div class="cfct-review-title">'.$review->name.'</div>
                      <div class="cfct-review-description">'.substr($review->content, 0, 120).'</div>
                    </label>
                  </li>';
                }
                foreach($this->pinned_reviews as $review){
                  if(!in_array($review->id, $featured_review_keys)){
                    $selected = false;
                    if(isset($review_id) && count($review_id>0)){
                      $selected = in_array($review->id, $review_id);
                    }
                    $html .= '
                    <li'.(($selected)?' class="selected"':'').'>
                      <div class="cfct-review-checkbox"><input type="checkbox" value="'.$review->id.'" id="'.$this->get_field_id('review_id').'_'.$review->id.'" name="'.$this->get_field_id('review_id').'[]" '.(($selected)?'checked="checked"':'').'/></div>
                      <label for="'.$this->get_field_id('review_id').'_'.$review->id.'" class="cfct-review-detail">
                        <div class="cfct-review-title">'.$review->name.'</div>
                        <div class="cfct-review-description">'.substr($review->content, 0, 120).'</div>
                      </label>
                    </li>';
                  }
                }
                $html .= '
                </ul>
              </div>
            </div>
          ';

					$html .= '
            <div id="'.$this->get_field_id('manual').'_selector" '.(($type!='manual')?' style="display:none;"':'').'>
              <div class="cfct-field">&nbsp;</div>
              <div class="cfct-field no-space">
                <label for="'.$this->get_field_id('rating').'">'.__('Rating').'</label>
                <div id="'.$this->get_field_id('rating').'_selector" data-score="'.$rating.'" data-score-name="'.$this->get_field_id('rating').'"></div>
              </div>
              <div class="cfct-field">
                <label for="'.$this->get_field_id('content').'">'.__('Review content').'</label>
                <textarea name="'.$this->get_field_name('content').'" id="'.$this->get_field_id('content').'">'.(!empty($data[$this->get_field_name('content')]) ? esc_html($data[$this->get_field_name('content')]) : '').'</textarea>
              </div>
              <div class="cfct-field">
                <label for="'.$this->get_field_id('name').'">'.__('Customer name').'</label>
                <input type="text" name="'.$this->get_field_name('name').'" id="'.$this->get_field_id('name').'" value="'.(!empty($data[$this->get_field_name('name')]) ? esc_html($data[$this->get_field_name('name')]) : '').'" />
              </div>
              <div class="cfct-field">
                <label for="'.$this->get_field_id('location').'">'.__('Location').'</label>
                <input type="text" name="'.$this->get_field_name('location').'" id="'.$this->get_field_id('location').'" value="'.(!empty($data[$this->get_field_name('location')]) ? esc_html($data[$this->get_field_name('location')]) : '').'" />
              </div>
            </div>
          ';

					$html .= '
            <div id="'.$this->get_field_id('interval').'_selector" class="cfct-field"'.(($type=='manual')?' style="display:none;"':'').'>
              <label for="'.$this->get_field_id('interval').'">'.__('Carrousel interval').'</label>
              <input type="text" name="'.$this->get_field_name('interval').'" id="'.$this->get_field_id('interval').'" value="'.(!empty($data[$this->get_field_name('interval')]) ? esc_html($data[$this->get_field_name('interval')]) : '4000').'" class="width-small" />
            </div>
          </div>
				</div>
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
      $type = (!empty($data[$this->get_field_name('type')]) ? esc_html($data[$this->get_field_name('type')]) : '');
      if($type=='') $type = $this->default_type;
			return $this->types[$type];
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
		
		public function admin_js() {
			$js = preg_replace('/^(\t){4}/m', '', '
        cfct_builder.addModuleLoadCallback("'.$this->id_base.'", function() {
          $("#'.$this->get_field_id('rating').'_selector").raty({
            "score": function(){return $(this).attr("data-score");},
            "path": ratyimgurl,
            "scoreName": function(){return $(this).attr("data-score-name");}
          });
          var container = $("#'.$this->id_base.'-content-fields");
          var ul;
          var li;
          $("label", container).mousedown(function(){return false;});
          $(".cfct-review-list li", container).live("mousedown", function(){return false;});
          $("li input[type=\'checkbox\']", container).live("change", function(){
            if($(this).is(":checked")){
              $(this).closest("li").addClass("selected");
            }
            else {
              $(this).closest("li").removeClass("selected");
            }
          });
          $("#'.$this->get_field_id('type').'", container).live("change", function(){
            var value = $(this).val();
            switch(value){
              case "featured":
                $("#'.$this->get_field_id('review_id').'_selector").slideUp("fast");
                $("#'.$this->get_field_id('manual').'_selector").slideUp("fast");
                $("#'.$this->get_field_id('interval').'_selector").slideDown("fast");
                break;
              case "select":
                $("#'.$this->get_field_id('manual').'_selector").slideUp("fast");
                $("#'.$this->get_field_id('review_id').'_selector").slideDown("fast");
                $("#'.$this->get_field_id('interval').'_selector").slideDown("fast");
                break;
              case "manual":
                $("#'.$this->get_field_id('interval').'_selector").slideUp("fast");
                $("#'.$this->get_field_id('review_id').'_selector").slideUp("fast");
                $("#'.$this->get_field_id('manual').'_selector").slideDown("fast");
                break;
            }
          });
        });
			');
			return $js;
		}
		
		public function admin_css() {
      return '
        #'.$this->get_field_id('rating').'_selector {
          display: inline-block;
          vertical-align: bottom;
        }
        #'.$this->id_base.'-content-fields {
          width: auto;
        }
        #'.$this->id_base.'-image-selectors div#'.$this->id_base.'-image-selector-tabs {
          margin-top: 0;
        }
        textarea#'.$this->id_base.'-content {
          height: 150px;
        }
        #'.$this->id_base.'-content-fields .cfct-field {
          margin: 5px 0;
        }
        #'.$this->id_base.'-content-fields .cfct-field label {
          display: inline-block;
          width: 100px;
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
        #'.$this->id_base.'-content-fields .cfct-review-list {
          display: block;
          border: 1px solid #CCCCCC;
          border-radius: 5px;
          moz-border-radius: 5px;
          o-border-radius: 5px;
          webkit-border-radius: 5px;
          background-color: #FFFFFF;
          padding: 5px;
        }
        #'.$this->id_base.'-content-fields .cfct-review-list li {
          margin-bottom: 5px;
          padding: 5px;
          background-color: #FAFAFA;
          border: 1px solid #CCCCCC;
          border-radius: 5px;
          moz-border-radius: 5px;
          o-border-radius: 5px;
          webkit-border-radius: 5px;
        }
        #'.$this->id_base.'-content-fields .cfct-review-list li:hover {
          border-color: #999999;
          background-color: #F0F0F0;
        }
        #'.$this->id_base.'-content-fields .cfct-review-list li.selected {
          background-color: #333333;
          border-color: #000000;
        }
        #'.$this->id_base.'-content-fields .cfct-review-list li.selected .cfct-review-title {
          color: #FFFFFF;
        }
        #'.$this->id_base.'-content-fields .cfct-review-list li.selected .cfct-review-description {
          color: #EEEEEE;
        }
        #'.$this->id_base.'-content-fields .cfct-review-checkbox {
          float: left;
          width: 15px;
          margin-right: 5px;
          position: relative;
          z-index: 1;
        }
        #'.$this->id_base.'-content-fields li label.cfct-review-detail {
          display: block;
          margin-left: 20px;
          min-height: 50px;
          width: auto;
        }
        #'.$this->id_base.'-content-fields .cfct-review-title {
          font-weight: bold;
          color: #333333;
          margin-bottom: 5px;
          font-size: 14px;
        }
        #'.$this->id_base.'-content-fields .cfct-review-description {
          color: #999999;
          font-size: 12px;
        }
      ';
		}
	}
	cfct_build_register_module('cfct_module_hatch_review');
}
?>
