jQuery(document).ready(function() {
	jQuery("#edit").click(function() {
		var id = jQuery("#group_id").val();
		var info = {};
		info['name'] = jQuery("#name").val();
		info['str_id'] = jQuery("#str_id").val();
		info['email'] = jQuery("#email").val();
	
		if(info['name'] != "" && info['str_id'] != "" && info['email'] != ""){
			var data = { 
							action: "edit_element",
							id: id,
							table: "groups",
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