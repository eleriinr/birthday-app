<?php 
$url = str_replace('muudaisik', 'isikud',$url);

global $wpdb;
	
	$table_name = $wpdb->prefix . 'isikud';
	$id = $_POST['id'];
	
	$retrieve_data = $wpdb->get_results("SELECT * FROM $table_name WHERE id=$id");
	$retrieved_data = $retrieve_data[0];
?>

<h1 class="h1 text-center my-4" >Muuda isik</h1>
<div class="container">
	<div class="row">
		<div class="col"></div>
		<div class="col">
			<a href=<?php echo $url; ?>>
				<button class="btn btn-danger mb-3">Tagasi</button>
			</a>
			
			<?php echo '<form action=' . $url . ' method="post">';?>
				<div class="form-group">
					<label for="eesnimi">Eesnimi: </label>
					<input class="form-control" id="eesnimi" type="text" value=<?php echo $retrieved_data->eesnimi; ?>>
				</div>
				<div class="form-group">
					<label for="perenimi">Perenimi: </label>
					<input class="form-control" id="perenimi" type="text" value=<?php echo $retrieved_data->perenimi; ?>>
				</div>
				<div class="form-group">
					<label for="kuupaev">Kuupäev: </label>
					<input class="form-control" id="kuupaev" type="date" value=<?php echo $retrieved_data->kuupaev; ?>>
				</div>
				<div class="form-group">
					<label for="email">Email: </label>
					<input class="form-control" id="email" type="email" value=<?php echo $retrieved_data->email; ?>>
				</div>
				<div class="form-group">
					<label for="email">Meili saaja: </label>
					<input class="form-control" id="emails" type="email" value=<?php echo $retrieved_data->saaja_email; ?>>
				</div>
				<div class="form-group">
					<label for="grupi_id">Grupi ID: </label>
					<input class="form-control" id="grupi_id" type="number" value=<?php echo $retrieved_data->grupi_id; ?>>
				</div>
				<div class="form-group">
					<label class="form-check-label" for="aktiivne">Aktiivne</label>
					<input type="checkbox"class="form-check-input mt-2 ml-2" id="aktiivne" <?php if($retrieved_data->aktiivne == 'Jah') echo 'checked';?>>
				</div>
				<input value="Muuda" id="edit" type="submit" class="btn btn-info pull-right d-block"> 
			</form>
		</div>
		<div class="col"></div>
	</div>
</div>
<script>
function isik_muuda(){
	jQuery.post( ajaxurl, { action: "isik_muuda", eesnimi: "John", perenimi: "Doe", kuupaev: "1996-01-09", email: "j.doe@gmail.com", grupi_id: "AK", aktiivne: "Jah"}).done(function( data ) {
			console.log( "Data loaded: " + data);
	});
}
	
jQuery(document).ready(function() {
		jQuery("#edit").on("click", isik_muuda);
	});
</script>