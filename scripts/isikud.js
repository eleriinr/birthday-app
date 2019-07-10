jQuery(document).ready(function() {
	jQuery(".delete").click(function() {
		var id = this.parentElement.parentElement.parentElement.id;
		$("tr#" + id).remove();
		
		var rows = $("tr");
		if(rows.length == 1){
			$("thead").attr("hidden", "hidden");
			$("#nopeople").removeAttr("hidden");
		}
		
		var data = { 
						action: "delete_element",
						id: id,
						table: "isikud"
		};
		
		$.ajax(ajaxurl, {
			"data": data,
			"type": "POST"
		})
		.done(function () {
			console.log("done");
		})
		.fail(function () {
			console.log("fail");
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
			console.log("done");
		})
		.fail(function () {
			console.log("fail");
		})
	});
})