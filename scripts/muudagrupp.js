jQuery(document).ready(function() {
	jQuery("#edit").click(function() {
		var id = <?php echo $id;?> ;
		var andmed = {};
		andmed['nimi'] = jQuery("#nimi").val();
		andmed['struktuuri_id'] = jQuery("#struktuuri_id").val();
		andmed['uldmeil'] = jQuery("#email").val();
	
		if(andmed['nimi'] != "" && andmed['struktuuri_id'] != "" && andmed['uldmeil'] != ""){
			var andmed = { 
							action: "muuda",
							id: id,
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