<?php $url = str_replace('lisaisik', 'isikud',$url);?>

<h1 class="h1 text-center my-4">Lisa isik</h1>
<div class="container">
	<div class="row">
		<div class="col"></div>
		<div class="col">
			<a href=<?php echo $url; ?>>
				<button class="btn btn-danger mb-4">Tagasi</button>
			</a>

			<?php echo '<form action=' . $url . ' method="post">';?>
				<div class="form-group">
					<label for="eesnimi">Eesnimi: </label>
					<input class="form-control" id="eesnimi" type="text" placeholder="Eesnimi">
				</div>
				<div class="form-group">
					<label for="perenimi">Perenimi: </label>
					<input class="form-control" id="perenimi" type="text" placeholder="Perenimi">
				</div>
				<div class="form-group">
					<label for="kuupaev">Kuupäev: </label>
					<input class="form-control" id="kuupaev" type="date">
				</div>
				<div class="form-group">
					<label for="email">Email: </label>
					<input class="form-control" id="email" type="email" placeholder="Email">
				</div>
				<div class="form-group">
					<label for="emails">Meili saaja: </label>
					<input class="form-control" id="saaja_email" type="email" placeholder="Saaja Email">
				</div>
				<div class="form-group">
					<label for="grupi_id">Grupi ID: </label>
					<input class="form-control" id="grupi_id" type="number" placeholder="ID">
				</div>
				<div class="form-group">
					<label class="form-check-label" for="aktiivne">Aktiivne</label>
					<input type="checkbox"class="form-check-input mt-2 ml-2" id="aktiivne">
				</div>
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
			var aktiivne = "Jah";
		
			var andmed = { action: "isik_lisa", eesnimi: eesnimi, perenimi: perenimi, kuupaev: kuupaev, email: email, saaja_email: saaja_email, grupi_id: grupi_id, aktiivne: aktiivne};
			
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
</script>