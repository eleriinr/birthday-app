jQuery(document).ready(function() {
	jQuery("#add").click(function() {
		var info = {};
		info['nimi'] = jQuery("#name").val();
		info['struktuuri_id'] = jQuery("#str_id").val();
		info['uldmeil'] = jQuery("#group_email").val();
		info['aktiivne'] = "Ei";
	
		if ( $("#active").is(':checked')) { 
			info['aktiivne'] = "Jah";
		}
			
		if(info['nimi'] != "" && info['struktuuri_id'] != "" && info['uldmeil'] != ""){
			var data = { 
							action: "add_element",
							table: "grupid",
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
		});
		}
	});
})