// Responsive design callback
$(cfct_builder).bind('responsive-update-response', function(evt, ret) {
	$('#' + ret.module_id).find('.cfct-module-status').remove();
	if (!ret.success) {
		ret.html = ret.html + "<p>Could not update classes.</p>";
		cfct_builder.doError(ret);
		return false;
	}

});
	
// Responsive CSS class selector handlers
$(document).on('click', 'a.cfct-responsive-trigger', function() {
	var _this = $(this);
	_this.parent().children('div.cfct-responsive-inner').toggle();
	return false;
});

$(document).on('click', 'div.cfct-responsive-inner li span', function() {
	var _this = $(this);
	_this.parent().find('input[type="checkbox"]').each(function() {
		$(this).trigger('click');
	});
	return false;
});

$(document).on('change', 'div.cfct-responsive-inner input[type="checkbox"]', function() {
	/**
	 * Change does not fire if you do
		if ($(this).is(':checked')) {
			$(this).removeAttr('checked');
		}
		else {
			$(this).attr('checked', 'checked');
		}
	 */

	$(this).parents('div.cfct-responsive-inner ul').trigger('cfct-responsive-update');
});

$(document).on('cfct-responsive-update', 'div.cfct-responsive-inner ul', function() {
	var _this = $(this);
	var toggle_link = _this.parents('div.cfct-responsive').find('a.cfct-responsive-trigger');
	//_this.parents('div.cfct-responsive').append(cfct_builder.spinner('&nbsp;'));
	var parent_module = _this.parents('div.cfct-module');
	cfct_builder.module_spinner(parent_module);

	var module_data = {
		'module_id':toggle_link.attr('href').slice(toggle_link.attr('href').indexOf('#')+1),
		'block_id':toggle_link.parents('.cfct-block').attr('id'),
		'row_id':toggle_link.parents('.cfct-row').attr('id'),
		'class_data': {}
	};
	
	_this.find('input[type="checkbox"]').each(function(idx, ele) {
		module_data.class_data[$(ele).attr('name')] = ($(ele).is(':checked') ? 1 : 0);
	});

	cfct_builder.fetch('responsive_update',
		module_data,
		'responsive-update-response'
	);
	return false;
});
