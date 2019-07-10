jQuery(document).ready(function() {
	jQuery("#edit").click(function() {
		var id = jQuery("#id").val();
		var info = {};
		info['eesnimi'] = jQuery("#first_name").val();
		info['perenimi'] = jQuery("#last_name").val();
		info['kuupaev'] = jQuery("#birthday").val();
		info['email'] = jQuery("#email").val();
		info['saaja_email'] = jQuery("#recipients_email").val();
		info['kommentaar'] = jQuery("#comment").val();
		info['grupi_id'] = jQuery("#group_id").val();
	
		if(info['eesnimi'] != "" && info['perenimi'] != "" && info['kuupaev'] != 0000-00-00 && info['email'] != "" && info['grupi_id'] != ""){
			var data = { 
							action: "edit_element",
							id: id,
							table: "isikud",
							data: info
			};
			
			$.ajax(ajaxurl, {
				"data": data,
				"type": "POST"
			})
			.done(function () {
				alert("isik muudetud: " + info['eesnimi'] + ' ' + info['perenimi']);
			})
			.fail(function () {
				alert("fail, isik muutmata: " + info['eesnimi'] + ' ' + info['perenimi']");
			})
		}
	});
})