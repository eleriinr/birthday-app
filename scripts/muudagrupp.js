jQuery(document).ready(function() {
	jQuery("#edit").click(function() {
		var id = jQuery("#group_id").val();
		var info = {};
		info['name'] = jQuery("#name").val();
		info['str_id'] = jQuery("#str_id").val();
		info['group_email'] = jQuery("#group_email").val();
		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		var valid = re.test(info['group_email']);

		if(!valid){
			event.preventDefault();
			$("#invalid").removeAttr("hidden");
			var box = $("#invalid").parentElement;
			box.classList.toggle("bg-danger");
			}
		else if(info['name'] != "" && info['str_id'] != ""){
			var data = { 
							action: "edit_element",
							id: id,
							table: "groups",
							data: info
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
		}
	});
})