jQuery(document).ready(function() {
	jQuery("#edit").click(function() {
		var id = <?php echo $id;?> ;
		var andmed = {};
		andmed['eesnimi'] = jQuery("#eesnimi").val();
		andmed['perenimi'] = jQuery("#perenimi").val();
		andmed['kuupaev'] = jQuery("#kuupaev").val();
		andmed['email'] = jQuery("#email").val();
		andmed['saaja_email'] = jQuery("#saaja_email").val();
		andmed['kommentaar'] = jQuery("#kommentaar").val();
		andmed['grupi_id'] = jQuery("#grupi_id").val();
	
		if(andmed['eesnimi'] != "" && andmed['perenimi'] != "" && andmed['kuupaev'] != 0000-00-00 && andmed['email'] != "" && andmed['grupi_id'] != ""){
			var andmed = { 
							action: "muuda",
							id: id,
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