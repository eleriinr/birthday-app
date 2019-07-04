<?php
//Destination url
$url = str_replace('lisagrupp', 'sunnipaevaplugin',$url);
?>

<h1 class="h1 text-center my-4" >Lisa grupp</h1>

<div class="container">
	<div class="row">
		<div class="col"></div>
		<div class="col"> 
			<a href=<?php echo $url; ?>>
				<button class="btn btn-danger mb-3">Tagasi</button>
			</a>

			<?php echo '<form action=' . $url . ' method="post">';?>
				<div class="form-group">
					<label for="nimi">Nimi: </label>
					<input class="form-control" id="nimi" type="text" placeholder="Nimi" required>
				</div>
				<div class="form-group">
					<label for="struktuuri_id">Struktuuri ID: </label>
					<input class="form-control" id="struktuuri_id" type="text" placeholder="ID" required>
				</div>
				<div class="form-group">
					<label for="email">Üldmeil: </label>
					<input class="form-control" id="email" type="email" placeholder="Email" required>
				</div>
				<div class="form-group">
					<label class="form-check-label" for="aktiivne">Aktiivne</label>
					<input type="checkbox"class="form-check-input mt-2 ml-2" id="aktiivne">
				</div>
				<input value="Lisa" id="add" type="submit" class="btn btn-info pull-right d-block"> 
			</form>
		</div>
		<div class="col"></div>
	</div>
</div>
<script>
jQuery(document).ready(function() {
	jQuery("#add").click(function() {
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
			.done(function () {
				console.log("done");
			})
			.fail(function () {
				console.log("fail");
			})
		}
	});
})
</script>
