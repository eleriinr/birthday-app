<?php 
//Destination url
$url = str_replace('lisaisik', 'isikud',$url);

//ID of the group
$id = $_POST['id'];
?>

<h1 class="h1 text-center my-4">Lisa isik</h1>

<div class="container">
	<div class="row">
		<div class="col"></div>
		<div class="col">
			
			<form method="post" action=<?php echo $url;?>>
					<input type="number" name="id" value="<?php echo $id; ?>" hidden>
					<input value="Tagasi" type="submit" class="btn btn-danger my-3">
			</form>
						
			<?php echo '<form action=' . $url . ' method="post">';?>
				<div class="form-group">
					<label for="eesnimi">Eesnimi: </label>
					<input class="form-control" id="eesnimi" type="text" placeholder="Eesnimi" required>
				</div>
				<div class="form-group">
					<label for="perenimi">Perenimi: </label>
					<input class="form-control" id="perenimi" type="text" placeholder="Perenimi" required>
				</div>
				<div class="form-group">
					<label for="kuupaev">Kuupäev: </label>
					<input class="form-control" id="kuupaev" type="date" required>
				</div>
				<div class="form-group">
					<label for="email">Email: </label>
					<input class="form-control" id="email" type="email" placeholder="Email" required>
				</div>
				<div class="form-group">
					<label for="emails">Meili saaja: </label>
					<input class="form-control" id="saaja_email" type="email" placeholder="Saaja Email">
				</div>
				<div class="form-group">
					<label for="grupi_id">Grupi ID: </label>
					<input class="form-control" id="grupi_id" type="number" value="<?php echo $id; ?>" placeholder="ID"  required>
				</div>
				<div class="form-group">
					<label class="form-check-label" for="aktiivne">Aktiivne</label>
					<input type="checkbox"class="form-check-input mt-2 ml-2" id="aktiivne">
				</div>
				<input type="number" name="id" value="<?php echo $id; ?>" hidden>
				<input value="Lisa" id="add" type="submit" class="btn btn-info pull-right mb-3 d-block"> 
			</form>
		</div>
		<div class="col"></div>
	</div>
</div>
<script>
jQuery(document).ready(function() {
	jQuery("#add").click(function() {
		var eesnimi = jQuery("#eesnimi").val();
		var perenimi = jQuery("#perenimi").val();
		var kuupaev = jQuery("#kuupaev").val();
		var email = jQuery("#email").val();
		var saaja_email = jQuery("#saaja_email").val();
		var grupi_id = jQuery("#grupi_id").val();
		var aktiivne = "Ei";

		if ( $("#aktiivne").is(':checked')) { 
			aktiivne = "Jah";
		}
		
		if(eesnimi != "" && perenimi != "" && kuupaev != 0000-00-00 && email != "" && grupi_id != ""){ 
			var andmed = { 
							action: "isik_lisa",
							eesnimi: eesnimi,
							perenimi: perenimi,
							kuupaev: kuupaev,
							email: email,
							saaja_email: saaja_email,
							grupi_id: grupi_id,
							aktiivne: aktiivne
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