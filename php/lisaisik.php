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
					<input class="form-control" id="emails" type="email" placeholder="Saaja Email">
				</div>
				<div class="form-group">
					<label for="grupi_id">Grupi ID: </label>
					<input class="form-control" id="grupi_id" type="number" placeholder="ID">
				</div>
				<div class="form-group">
					<label class="form-check-label" for="aktiivne">Aktiivne</label>
					<input type="checkbox"class="form-check-input mt-2 ml-2" id="aktiivne">
				</div>
				<input value="Lisa" type="submit" class="btn btn-info pull-right mb-3 d-block"> 
			</form>
		</div>
		<div class="col"></div>
	</div>
</div>
<script>
function isik_lisa(){
	jQuery.post( ajaxurl, { action: "isik_lisa", eesnimi: "John", perenimi: "Doe", kuupaev: "1996-01-09", email: "j.doe@gmail.com", grupi_id: "AK", aktiivne: "Jah"}).done(function( data ) {
			console.log( "Data loaded: " + data);
	});
}
	
jQuery(document).ready(function() {
		jQuery(".add").on("click", isik_lisa);
	});
</script>