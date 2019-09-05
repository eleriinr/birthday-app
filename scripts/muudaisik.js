jQuery(document).ready(function() {
	jQuery("#edit").click(function(event) {
		$("#invalid").attr("hidden", "hidden");
		$("#invalidrecipient").attr("hidden", "hidden");
		
		var id = jQuery("#id").val();
		var info = {};
		info['first_name'] = jQuery("#first_name").val();
		info['last_name'] = jQuery("#last_name").val();
		info['birthday'] = jQuery("#birthday").val();
		info['email'] = jQuery("#email").val();
		info['recipients_email'] = jQuery("#recipients_email").val();
		info['comment'] = jQuery("#comment").val();
		info['group_id'] = jQuery("#group_id").val();
	
		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		var valid = re.test(info['email']);
	
		var recipients_valid = true;
		if(info['recipients_email'] != ""){
			var recipients = info['recipients_email'].split(",");
			for(var i = 0; i < recipients.length; i++){
				var val = recipients[i];
				val = val.trim();
				if(!re.test(val)){
				  recipients_valid = false;
				  break;
				}
			}
		}
		if(!valid){
			event.preventDefault();
			$("#invalid").removeAttr("hidden");
			var box = $("#invalid").parentElement;
			box.classList.toggle("bg-danger");
			}
		if(!recipients_valid){
			event.preventDefault();
			$("#invalidrecipient").removeAttr("hidden");
			var box2 = $("#invalidrecipient").parentElement;
			box2.classList.toggle("bg-danger");
			}
		if(info['first_name'] != "" && info['last_name'] != "" && info['birthday'] != 0000-00-00 && valid && recipients_valid && info['group_id'] != ""){
			var data = { 
							action: "edit_element",
							id: id,
							table: "people",
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