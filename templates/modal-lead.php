<?php
/**
 * Description: New lead modal.
 *
 * @package 
 * @subpackage 
 * @since 
 */
?>

<!-- Lead Modal -->
<div class="big-modal">
  <div class="modal hide fade bg-slate" id="new-lead">
    <div class="modal-header center bumper-top bumper-bottom">
      <h3>Home of the <strong class="green">$1000</strong> streak free guarantee.</h3>
    </div>
    <div class="modal-body center bumper-top">
      <div>
        <div class="input-prepend">
            <span class="add-on"><i class="icon-user"></i></span>
            <input id="lead-name" validation="not-empty" data-field-name="Name" placeholder="Your Name" type="text" value="" />
        </div>
      </div>
      <div>
        <div class="input-prepend">
            <span class="add-on"><i class="icon-envelope"></i></span>
            <input id="lead-email" validation="not-empty email" placeholder="Email Address" type="text" value="" />
        </div>
      </div>
      <div>
        <div class="input-prepend">
            <span class="add-on"><i class="icon-phone-halfling"></i></span>
            <input id="lead-phone" validation="not-empty phone" placeholder="Phone Number" type="text" value="" />
        </div>
      </div><?php if(!strstr($_SERVER['HTTP_HOST'], 'windowcleaning.com')){ ?>
      <div>
        <div class="input-prepend"><?php
        require_once(TOOLBOX_INC.'/recaptchalib.php');
        echo recaptcha_get_html('6LeWPOMSAAAAAFOhDTuE_puAVHNqL3ff8R4tXsKq');
      ?></div>
      </div><?php } ?>
      <div class="bumper-top-small bumper-bottom">
        <div class="pen-stroke"></div>
      </div>
      <p class="page-left page-right">We receive your request instantly via SMS and usually <strong><u>respond within minutes!</u></strong></p>
    </div>

    <div class="modal-footer center">
      <a href="" class="btn btn-large btn-success save">Quick free estimate</a>
    </div>
  </div>
</div>
<!-- / modal -->