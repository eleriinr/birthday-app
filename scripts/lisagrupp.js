jQuery(document).ready(function() {
	jQuery("#add").click(function() {
		var andmed = {};
		andmed['nimi'] = jQuery("#nimi").val();
		andmed['struktuuri_id'] = jQuery("#struktuuri_id").val();
		andmed['uldmeil'] = jQuery("#email").val();
		andmed['aktiivne'] = "Ei";
	
		if ( $("#aktiivne").is(':checked')) { 
			andmed['aktiivne'] = "Jah";
		}
			
		if(andmed['nimi'] != "" && andmed['struktuuri_id'] != "" && andmed['uldmeil'] != ""){
			var andmed = { 
							action: "lisa",
							tabel: "grupid",
							andmed: andmed
			};
			
			$.ajax(ajaxurl, {
				"data": andmed,
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