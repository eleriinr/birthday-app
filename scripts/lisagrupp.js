jQuery(document).ready(function() {
	jQuery("#add").click(function() {
		var info = {};
		info['name'] = jQuery("#name").val();
		info['str_id'] = jQuery("#str_id").val();
		info['email'] = jQuery("#email").val();
		info['active'] = "No";
		if ( $("#active").is(':checked')) { 
			info['active'] = "Yes";
		}
		if(info['name'] != "" && info['str_id'] != "" && info['email'] != ""){
			var data = { 
							action: "add_element",
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