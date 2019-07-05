jQuery(document).ready(function() {
	jQuery("#edit").click(function() {
		var id = jQuery("#grupi_id").val();
		var grupp = {};
		grupp['nimi'] = jQuery("#nimi").val();
		grupp['struktuuri_id'] = jQuery("#struktuuri_id").val();
		grupp['uldmeil'] = jQuery("#email").val();
	
		if(grupp['nimi'] != "" && grupp['struktuuri_id'] != "" && grupp['uldmeil'] != ""){
			var andmed = { 
							action: "muuda",
							id: id,
							tabel: "grupid",
							andmed: grupp
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