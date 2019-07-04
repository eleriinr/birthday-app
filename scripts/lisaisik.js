jQuery(document).ready(function() {
	jQuery("#add").click(function() {
		var andmed = {};
		andmed['eesnimi'] = jQuery("#eesnimi").val();
		andmed['perenimi'] = jQuery("#perenimi").val();
		andmed['kuupaev'] = jQuery("#kuupaev").val();
		andmed['email'] = jQuery("#email").val();
		andmed['saaja_email'] = jQuery("#saaja_email").val();
		andmed['kommentaar'] = jQuery("#kommentaar").val();
		andmed['grupi_id'] = jQuery("#grupi_id").val();
		andmed['aktiivne'] = "Ei";
	
		if ( $("#aktiivne").is(':checked')) { 
			andmed['aktiivne'] = "Jah";
		}
		
		if(andmed['eesnimi'] != "" && andmed['perenimi'] != "" && andmed['kuupaev'] != 0000-00-00 && andmed['email'] != "" && andmed['grupi_id'] != ""){
			var andmed = { 
							action: "lisa",
							tabel: "isikud",
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