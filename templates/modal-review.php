<?php
/**
 * Description: Reviews modal.
 *
 * @package 
 * @subpackage 
 * @since 
 */

$id = get_the_ID();
$add_review = false;
if(isset($id) && isset($_REQUEST[wp_create_nonce('review-'.$id)])){
  $prj = get_project_details(get_post($id));
  if(!isset($prj->any_review) || !$prj->any_review){
    $add_review = true;
  }
}
$review_first_name = (isset($prj->contact->first_name) && $prj->contact->first_name!='')?$prj->contact->first_name:'';
$review_last_name = (isset($prj->contact->last_name) && $prj->contact->last_name!='')?$prj->contact->last_name:'';
$review_email = (isset($prj->contact->email) && $prj->contact->email!='')?$prj->contact->email:'';
$review_company = (isset($prj->contact->company) && $prj->contact->company!='')?$prj->contact->company:'';
$review_location = (isset($prj->contact->city) && $prj->contact->city!='')?$prj->contact->city:'';
?>

<!-- Review Modal -->
<div class="big-modal">
  <div class="modal hide fade" id="new-review"<?=($add_review)?' data-project-id="'.$id.'"':''?>>
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h3><?=($review_first_name!='' || $review_last_name!='')?'Hi '.$review_first_name.(($review_first_name!='' && $review_last_name!='')?' ':'').$review_last_name.', how did we do?"':'So, how did we do?'?></h3>
    </div>
    <div class="modal-body">

      <!-- Centre selectable star rating here above text box -->
      <div class="select-review-rating">
        <div id="comment-rating"></div>
      </div>
      <div>
        <textarea id="comment-content" class="input-block-level" placeholder="Write your review." rows="3"></textarea>
      </div>
      <input type="hidden" id="comment-via" value="register" />
      <input type="hidden" id="social-media-id" value="" />
      <div class="social-comment">
        <div class="social-login">
          <p class="bumper-top-small"> Login with <a href="" class="comment-via-fb"><i class="icon-facebook"></i> Facebook</a>, <a href="" class="comment-via-twitter"><i class="icon-twitter"></i> Twitter</a> or <a href="" class="comment-via-register">Register</a> to add your review.</p>
        </div>
        <div class="social-user"></div>
      </div>
      <!-- Show this if the user chooses the register option -->
      <div class="guest-comment hide">
        <div class="row-fluid bumper-top-small">
          <div class="span6">
            <div class="input-prepend">
              <span class="add-on"><i class="icon-user"></i></span>
              <input id="comment-name" class="input-block-level" validation="not-empty" placeholder="Your Name" type="text"<?=($review_first_name!='' || $review_last_name!='')?' value="'.$review_first_name.(($review_first_name!='' && $review_last_name!='')?' ':'').$review_last_name.'"':''?> />
            </div>
          </div>
          <div class="span6">
            <div class="input-prepend">
              <span class="add-on"><i class="icon-user"></i></span>
              <input id="comment-company" class="input-block-level" placeholder="Company" type="text"<?=($review_company!='')?' value="'.$review_company.'"':''?> />
            </div>
          </div>
        </div>
        <div class="row-fluid">
          <div class="span6">
            <div class="input-prepend">
              <span class="add-on"><i class="icon-envelope"></i></span>
              <input id="comment-email" class="input-block-level lowercase-only" validation="not-empty email" placeholder="Email Address" type="email"<?=($review_email!='')?' value="'.$review_email.'"':''?> />
            </div>
          </div>
          <div class="span6">
            <div class="input-prepend">
              <span class="add-on"><i class="icon-map-marker"></i></span>
              <input id="comment-location" class="input-block-level" validation="not-empty" placeholder="Location" type="text"<?=($review_location!='')?' value="'.$review_location.'"':''?> />
            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="modal-footer">
      <div class="pull-left">
        <!-- Only show share on ... option if the user logged in with social network -->
        <div class="post-to-my-social-media form-inline pull-left hidden">
          <input id="review-social-post" type="checkbox" value="1" name="review-social-post" checked="checked" /> <label for="review-social-post"><small>Share on <span class="social-media-name">Facebook</span></small></label>
        </div>
      </div>
      <a href="javascript:void(0);" class="btn btn-success save disabled<?=(($review_first_name!='' || $review_last_name!='') && $review_email!='' && $review_company!='' && $review_location!='')?' solid':''?>">Add Review</a>
    </div>
  </div>
</div>
<!-- / modal -->

