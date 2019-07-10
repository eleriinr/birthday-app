jQuery(document).ready(function() {
	var ridu = $("tr");
	if(ridu.length == 1){
			$("#nopeople").removeAttr("hidden");
	}
	else{
		$("thead").removeAttr("hidden");
	}
	jQuery(".delete").click(function() {
		var id = this.parentElement.parentElement.parentElement.id;
		$("tr#" + id).remove();
		
		var ridu = $("tr");
		if(ridu.length == 1){
			$("thead").attr("hidden", "hidden");
			$("#nopeople").removeAttr("hidden");
		}
		
		var andmed = { 
						action: "delete_element",
						id: id,
						table: "isikud"
		};
		
		$.ajax(ajaxurl, {
			"data": andmed,
			"type": "POST"
		})
		.done(function () {
			console.log('isik kustutatud: ' + id);
		})
		.fail(function () {
			console.log('fail, isik kustutamata: ' + id);
		});
	});
	
	jQuery(".active").click(function() {
		var row = this.parentElement.parentElement;
		var id = row.id;
		var box = $("#box" + id);
		var active = "Ei";

		if ( box.is(':checked') ) {
			active = "Jah";
		}
		
		row.classList.toggle("table-danger");
		
		var data = { 
						action: "edit_activity",
						id: id,
						active: active,
						table: "isikud"
		};
		
		$.ajax(ajaxurl, {
			"data": data,
			"type": "POST"
		})
		.done(function () {
			console.log("isiku aktiivsus muudetud");
		})
		.fail(function () {
			console.log("fail, isiku aktiivsus pole muudetud");
		})
	});
})