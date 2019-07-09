jQuery(document).ready(function() {
	jQuery("#edit").click(function() {
		var id = jQuery("#isiku_id").val();
		var isik = {};
		isik['eesnimi'] = jQuery("#eesnimi").val();
		isik['perenimi'] = jQuery("#perenimi").val();
		isik['kuupaev'] = jQuery("#kuupaev").val();
		isik['email'] = jQuery("#email").val();
		isik['saaja_email'] = jQuery("#saaja_email").val();
		isik['kommentaar'] = jQuery("#kommentaar").val();
		isik['grupi_id'] = jQuery("#grupi_id").val();
	
		if(isik['eesnimi'] != "" && isik['perenimi'] != "" && isik['kuupaev'] != 0000-00-00 && isik['email'] != "" && isik['grupi_id'] != ""){
			var andmed = { 
							action: "muuda",
							id: id,
							tabel: "isikud",
							andmed: isik
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