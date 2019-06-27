<?php 
$url = str_replace('muudagrupp', 'sunnipaevaplugin',$url);

global $wpdb;
	
	$table_name = $wpdb->prefix . 'grupid';
	$id = $_POST['id'];
	
	$retrieve_data = $wpdb->get_results("SELECT * FROM $table_name WHERE id=$id");
	$retrieved_data = $retrieve_data[0];
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
					<input class="form-control" id="grupi_id" type="number" value=<?php echo $retrieved_data->id; ?> readonly>
				</div>
				<div class="form-group">
					<label for="nimi">Nimi: </label>
					<input class="form-control" id="nimi" type="text" placeholder="Nimi" value=<?php echo $retrieved_data->nimi; ?>>
				</div>
				<div class="form-group">
					<label for="struktuuri_id">Struktuuri ID: </label>
					<input class="form-control" id="struktuuri_id" type="text" placeholder="ID" value=<?php echo $retrieved_data->struktuuri_id; ?>>
				</div>
				<div class="form-group">
					<label for="email">Üldmeil: </label>
					<input class="form-control" id="email" type="email" placeholder="Email" value=<?php echo $retrieved_data->uldmeil; ?>>
				</div>
				<div class="form-group">
					<label class="form-check-label" for="aktiivne">Aktiivne</label>
					<input type="checkbox"class="form-check-input mt-2 ml-2" id="aktiivne" <?php if($retrieved_data->aktiivne == 'Jah') echo 'checked';?>>
				</div>
				<input value="Muuda" type="submit" id="edit" class="btn btn-info pull-right d-block"> 
			</form>
		</div>
		<div class="col"></div>
	</div>
</div>
<script>
function grupp_muuda(){
	$.ajax({
		type: 'POST',
		url: ajaxurl,
		data: {action: "grupp_muuda", nimi: "Grupp3", struktuuri_id: "AT", uldmeil: "ut.ak@lists.ut.ee" aktiivne: "Jah"},
		dataType: 'json',
		contentType:"application/json; charset=utf-8"
	})
	.done(function() {
		console.log('done');
	})
	.fail(function() {
		console.log('fail');
	});
}
	
jQuery(document).ready(function() {
		jQuery("#edit").on("click", grupp_muuda);
	});
</script>