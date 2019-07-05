jQuery(document).ready(function() {
	jQuery(".delete").click(function() {
		var id = this.parentElement.parentElement.parentElement.id;
		$("tr#" + id).remove();
	
		var andmed = {
						action: "kustuta",
						id: id,
						tabel: "grupid"
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
		});
	});
	
	jQuery(".aktiivne").click(function() {
		var rida = this.parentElement.parentElement;
		var id = rida.id;
		var kast = $("#kast" + id);
		var aktiivne = "Ei";

		if ( kast.is(':checked') ) { 
			aktiivne = "Jah";
			rida.classList.remove("table-danger");
		}
		else{
			rida.classList.add("table-danger");
		}
		
		var andmed = { 
						action: "muuda_aktiivsust",
						id: id,
						aktiivne: aktiivne,
						tabel: "grupid"
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
	});
})