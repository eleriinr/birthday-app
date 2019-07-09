jQuery(document).ready(function() {
	jQuery(".delete").click(function() {
		var id = this.parentElement.parentElement.parentElement.id;
		$("tr#" + id).remove();
	
		var data = {
						action: "delete_element",
						id: id,
						table: "grupid"
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
			row.classList.remove("table-danger");
		}
		else{
			row.classList.add("table-danger");
		}
		
		var data = { 
						action: "edit_activity",
						id: id,
						active: active,
						table: "grupid"
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