jQuery(document).ready(function() {
	alert('loaded');
	jQuery("#add").click(function() {
		alert('add');
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
		.done(function (result, status, xhr) {
			console.log(status);
		})
		.fail(function (result, status, xhr) {
			console.log('fail: ' + status);
		});
		}
	});
})