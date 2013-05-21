<?php
/**
 * Description: Reviews modal.
 *
 * @package 
 * @subpackage 
 * @since 
 */
?>

<!-- Review Modal -->
<div class="big-modal">
  <div class="modal hide fade" id="new-review">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h3>So, how did we do?</h3>
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
          <p class="bumper-top-small"> Login with <a href="" class="comment-via-fb"><i class="icon-facebook"></i> Facebook</a>, <a href="" class="comment-via-twitter"><i class="icon-twitter"></i> Twitter</a> or <a href="" class="comment-via-register">register</a> to add your review.</p>
        </div>
        <div class="social-user"></div>
      </div>
      <!-- Show this if the user chooses the register option -->
      <div class="guest-comment hide">
        <div class="row-fluid bumper-top-small">
          <div class="span6">
            <div class="input-prepend">
              <span class="add-on"><i class="icon-user"></i></span>
              <input id="comment-name" class="input-block-level" validation="not-empty" placeholder="Your Name" type="text" />
            </div>
          </div>
          <div class="span6">
            <div class="input-prepend">
              <span class="add-on"><i class="icon-user"></i></span>
              <input id="comment-company" class="input-block-level" placeholder="Company" type="text" />
            </div>
          </div>
        </div>
        <div class="row-fluid">
          <div class="span6">
            <div class="input-prepend">
              <span class="add-on"><i class="icon-envelope"></i></span>
              <input id="comment-email" class="input-block-level" validation="not-empty email" placeholder="Email Address" type="text" />
            </div>
          </div>
          <div class="span6">
            <div class="input-prepend">
              <span class="add-on"><i class="icon-map-marker"></i></span>
              <input id="comment-location" class="input-block-level" validation="not-empty" placeholder="Location" type="text" />
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
      <a href="javascript:void(0);" class="btn btn-success save disabled">Add Review</a>
    </div>
  </div>
</div>
<!-- / modal -->

