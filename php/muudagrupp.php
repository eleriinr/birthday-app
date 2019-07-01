<?php
//Destination url
$url = str_replace('muudagrupp', 'sunnipaevaplugin',$url);

//Acquiring the necessary data from the 'grupid' table
global $wpdb;
	
	$table_name = $wpdb->prefix . 'grupid';
	
	//ID of the group
	$id = $_POST['id'];
	
	$retrieve_data = $wpdb->get_results("SELECT * FROM $table_name WHERE id=$id");
	$retrieved_data = $retrieve_data[0];

//Data
$id = $retrieved_data->id;
$nimi = $retrieved_data->nimi;
$struktuuri_id = $retrieved_data->struktuuri_id;
$uldmeil = $retrieved_data->uldmeil;
?>

<h1 class="h1 text-center my-4" >Muuda gruppi</h1>
<div class="container">
	<div class="row">
		<div class="col"></div>
		<div class="col">
			<a href=<?php echo $url; ?>>
				<button class="btn btn-danger mb-3">Tagasi</button>
			</a>

			<?php echo '<form action=' . $url . ' method="post">';?>
				<div class="form-group">
					<label for="grupi_id">Grupi ID: </label>
					<input class="form-control" id="grupi_id" type="number" value="<?php echo $id; ?>" readonly>
				</div>
				<div class="form-group">
					<label for="nimi">Nimi: </label>
					<input class="form-control" id="nimi" type="text" placeholder="Nimi" value="<?php echo $nimi; ?>" required>
				</div>
				<div class="form-group">
					<label for="struktuuri_id">Struktuuri ID: </label>
					<input class="form-control" id="struktuuri_id" type="text" placeholder="ID" value="<?php echo $struktuuri_id; ?>" required>
				</div>
				<div class="form-group">
					<label for="email">Üldmeil: </label>
					<input class="form-control" id="email" type="email" placeholder="Email" value="<?php echo $uldmeil; ?>" required>
				</div>
				<input value="Muuda" type="submit" id="edit" class="btn btn-info pull-right d-block"> 
			</form>
		</div>
		<div class="col"></div>
	</div>
</div>
<script>
jQuery(document).ready(function() {
	jQuery("#edit").click(function() {
		var id = jQuery("#grupi_id").val();
		var nimi = jQuery("#nimi").val();
		var struktuuri_id = jQuery("#struktuuri_id").val();
		var uldmeil = jQuery("#email").val();
		
		if(nimi != "" && struktuuri_id != "" && uldmeil != ""){
			var andmed = { 
							action: "grupp_muuda",
							id: id,
							nimi: nimi,
							struktuuri_id: struktuuri_id,
							uldmeil: uldmeil
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