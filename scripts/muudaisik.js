jQuery(document).ready(function() {
	jQuery("#edit").click(function() {
		var id = jQuery("#id").val();
		var info = {};
		info['first_name'] = jQuery("#first_name").val();
		alert('fn: ' + info['first_name']);
		info['last_name'] = jQuery("#last_name").val();
		alert('ln: ' + info['last_name']);
		info['birthday'] = jQuery("#birthday").val();
		alert('bd: ' + info['birthday']);
		info['email'] = jQuery("#email").val();
		alert('em: ' + info['email']);
		info['recipients_email'] = jQuery("#recipients_email").val();
		alert('rem: ' + info['recipients_email']);
		info['comment'] = jQuery("#comment").val();
		alert('cm: ' + info['comment']);
		info['group_id'] = jQuery("#group_id").val();
		alert('gid: ' + info['group_id']);
	
		if(info['first_name'] != "" && info['last_name'] != "" && info['birthday'] != 0000-00-00 && info['email'] != "" && info['group_id'] != ""){
			var data = { 
							action: "change_element",
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