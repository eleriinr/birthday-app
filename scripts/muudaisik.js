jQuery(document).ready(function() {
	jQuery("#edit").click(function() {
		var id = jQuery("#id").val();
		var info = {};
		info['first_name'] = jQuery("#first_name").val();
		info['last_name'] = jQuery("#last_name").val();
		info['birthday'] = jQuery("#birthday").val();
		info['email'] = jQuery("#email").val();
		info['recipients_email'] = jQuery("#recipients_email").val();
		info['comment'] = jQuery("#comment").val();
		info['group_id'] = jQuery("#group_id").val();
	
		if(info['first_name'] != "" && info['last_name'] != "" && info['birthday'] != 0000-00-00 && info['email'] != "" && info['group_id'] != ""){
			var data = { 
							action: "edit_element",
							id: id,
							table: "people",
							data: info
			};
			
			$.ajax(ajaxurl, {
				"data": data,
				"type": "POST"
			})
			.done(function () {
				console.log("done");
			})
			.fail(function () {
				console.log("fail");
			})
		}
	});
})