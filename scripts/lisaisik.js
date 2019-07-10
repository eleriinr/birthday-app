jQuery(document).ready(function() {
	jQuery("#add").click(function() {
		var info = {};
		info['eesnimi'] = jQuery("#first_name").val();
		info['perenimi'] = jQuery("#last_name").val();
		info['kuupaev'] = jQuery("#birthday").val();
		info['email'] = jQuery("#email").val();
		info['saaja_email'] = jQuery("#recipients_email").val();
		info['kommentaar'] = jQuery("#comment").val();
		info['grupi_id'] = jQuery("#group_id").val();
		info['aktiivne'] = "Ei";
	
		if ( $("#active").is(':checked')) { 
			info['aktiivne'] = "Jah";
		}
		
		if(info['eesnimi'] != "" && info['perenimi'] != "" && info['kuupaev'] != 0000-00-00 && info['email'] != "" && info['grupi_id'] != ""){
			var data = { 
							action: "add_element",
							table: "isikud",
							data: info
			};
			
			$.ajax(ajaxurl, {
				"data": data,
				"type": "POST"
			})
			.done(function () {
				alert("isik lisatud: " + info['eesnimi'] + ' ' + info['perenimi']);
			})
			.fail(function () {
				alert("fail, isik lisamata: " + info['eesnimi'] + ' ' + info['perenimi']);
			})
		}
	});
})