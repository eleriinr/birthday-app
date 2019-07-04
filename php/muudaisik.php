<?php 
//Destination url
$url = str_replace('muudaisik', 'isikud',$url);

//Acquiring the necessary data from the 'isikud' table
global $wpdb;
	
$table_name = $wpdb->prefix . 'isikud';
	
//ID of the person
$id = $_POST['id'];
	
$retrieve_data = $wpdb->get_results("SELECT * FROM $table_name WHERE id=$id");
$retrieved_data = $retrieve_data[0];
	
//Data
$eesnimi = $retrieved_data->eesnimi;
$perenimi = $retrieved_data->perenimi;
$kuupaev = $retrieved_data->kuupaev;
$email = $retrieved_data->email;
$saaja_email = $retrieved_data->saaja_email;
$kommentaar = $retrieved_data->kommentaar;
$grupi_id = $retrieved_data->grupi_id;
?>

<h1 class="h1 text-center my-4" >Muuda isik</h1>

<div class="container">
	<div class="row">
		<div class="col"></div>
		<div class="col">
			<form method="post" action=<?php echo $url;?>>
					<input type="number" name="id" value="<?php echo $grupi_id; ?>" hidden>
					<input value="Tagasi" type="submit" class="btn btn-danger my-3">
			</form>
			
			<?php echo '<form action=' . $url . ' method="post">';?>
				<div class="form-group">
					<label for="eesnimi">Eesnimi: </label>
					<input class="form-control" id="eesnimi" type="text" value="<?php echo $eesnimi; ?>" required>
				</div>
				<div class="form-group">
					<label for="perenimi">Perenimi: </label>
					<input class="form-control" id="perenimi" type="text" value="<?php echo $perenimi; ?>" required>
				</div>
				<div class="form-group">
					<label for="kuupaev">Kuupäev: </label>
					<input class="form-control" id="kuupaev" type="date" value="<?php echo $kuupaev; ?>" required>
				</div>
				<div class="form-group">
					<label for="email">Email: </label>
					<input class="form-control" id="email" type="email" value="<?php echo $email; ?>" required>
				</div>
				<div class="form-group">
					<label for="email">Meili saaja: </label>
					<input class="form-control" id="saaja_email" type="email" value="<?php echo $saaja_email; ?>">
				</div>
				<div class="form-group">
					<label for="kommentaar">Kommentaar: </label>
					<input class="form-control" id="kommentaar" type="text" value="<?php echo $kommentaar; ?>">
				</div>
				<div class="form-group">
					<label for="grupi_id">Grupi ID: </label>
					<input class="form-control" id="grupi_id" type="number" value="<?php echo $grupi_id; ?>" required>
				</div>
				<input type="number" name="id" value="<?php echo $grupi_id; ?>" hidden>
				<input value="Muuda" id="edit" type="submit" class="btn btn-info pull-right d-block"> 
			</form>
		</div>
		<div class="col"></div>
	</div>
</div>
<script>
jQuery(document).ready(function() {
	jQuery("#edit").click(function() {
		
		var id = <?php echo $id;?> ;
		var andmed = {};
		andmed['eesnimi'] = jQuery("#eesnimi").val();
		andmed['perenimi'] = jQuery("#perenimi").val();
		andmed['kuupaev'] = jQuery("#kuupaev").val();
		andmed['email'] = jQuery("#email").val();
		andmed['saaja_email'] = jQuery("#saaja_email").val();
		andmed['kommentaar'] = jQuery("#kommentaar").val();
		andmed['grupi_id'] = jQuery("#grupi_id").val();
	
		if(andmed['eesnimi'] != "" && andmed['perenimi'] != "" && andmed['kuupaev'] != 0000-00-00 && andmed['email'] != "" && andmed['grupi_id'] != ""){
			var andmed = { 
							action: "muuda",
							id: id,
							tabel: "isikud",
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