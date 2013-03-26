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
<div class="modal hide fade" id="new-review">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>So, how did we do?</h3>
	</div>
	<div class="modal-body">
	
		<!-- Centre selectable star rating here above text box -->
		
		<textarea class="input-block-level" placeholder="Write your review." rows="3"></textarea>
		<p class="bumper-top-small"> Login with <a href=""><i class="icon-facebook"></i> Facebook</a> or <a href=""><i class="icon-twitter"></i> Twitter</a>, or <a href="">register</a> to add your review.</p>
		
		<!-- Show this if the user chooses the register option -->
		<div class="hide">
			<div class="row-fluid bumper-top-small">
				<div class="span6">
					<div class="input-prepend">
					    <span class="add-on"><i class="icon-user"></i></span>
					    <input class="input-block-level" placeholder="Your Name" type="text">
					</div>
				</div>
				<div class="span6">
					<div class="input-prepend">
					    <span class="add-on"><i class="icon-user"></i></span>
					    <input class="input-block-level" placeholder="Company" type="text">
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span6">
					<div class="input-prepend">
					    <span class="add-on"><i class="icon-envelope"></i></span>
					    <input class="input-block-level" validation="email" placeholder="Email Address" type="text">
					</div>
				</div>
			</div>
		</div>
		
	</div>
	
	<div class="modal-footer">
		<div class="pull-left">
			<!-- Only show share on ... option if the user logged in with social network -->
			<p><small><input type="checkbox" name="" value="" checked="checked" /> <span>Share on Facebook</span></small></p>
		</div>
		<a href="javascript:void(0);" class="btn btn-success save">Add Review</a>
	</div>
</div>
<!-- / modal -->

