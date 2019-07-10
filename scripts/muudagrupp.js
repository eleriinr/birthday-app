jQuery(document).ready(function() {
	jQuery("#edit").click(function() {
		var id = jQuery("#group_id").val();
		var info = {};
		info['nimi'] = jQuery("#name").val();
		info['struktuuri_id'] = jQuery("#str_id").val();
		info['uldmeil'] = jQuery("#group_email").val();
	
		if(info['nimi'] != "" && info['struktuuri_id'] != "" && info['uldmeil'] != ""){
			var data = { 
							action: "edit_element",
							id: id,
							table: "grupid",
							data: info
			};
			
			$.ajax(ajaxurl, {
				"data": data,
				"type": "POST"
			})
			.done(function () {
				alert("grupp muudetud: " + info['nimi']);
			})
			.fail(function () {
				alert("fail, grupp muutmata: " + info['nimi']);
			})
		}
	});
})