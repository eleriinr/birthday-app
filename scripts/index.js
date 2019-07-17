jQuery(document).ready(function() {
	jQuery(".delete").click(function() {
		var id = this.parentElement.parentElement.parentElement.id;
		$("tr#" + id).remove();
		
		var rows = $("tr");
		if(rows.length == 1){
			$("thead").attr("hidden", "hidden");
			$("#nogroups").removeAttr("hidden");
			$("#addgroupbutton").attr("hidden", "hidden");
			$("#addgroupbuttoncenter").removeAttr("hidden");
			
		}
		
		var data = {
						action: "delete_element",
						id: id,
						table: "groups"
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
		var active = "No";

		if ( box.is(':checked') ) { 
			active = "Yes";
		}
		
		row.classList.toggle("table-danger");
		
		var data = { 
						action: "edit_activity",
						id: id,
						active: active,
						table: "groups"
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
	
	
	jQuery(".peoples_table").click(function(){
		var id = this.id;
		
		var data = { 
						action: "edit_current",
						id: id,
						table: "groups"
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
	
	
	jQuery(".edit").click(function(){
		var id = this.id;
		
		var data = { 
						action: "edit_current",
						id: id,
						table: "groups"
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