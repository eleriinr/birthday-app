<?php 
//Destination urls 
$isikud_url = str_replace('sunnipaevaplugin','isikud',$url);
$muudagrupp_url = str_replace('sunnipaevaplugin','muudagrupp',$url);
$lisagrupp_url = str_replace('sunnipaevaplugin','lisagrupp',$url);

//Acquiring the data from the 'grupid' table
global $wpdb;
	
	$table_name = $wpdb->prefix . 'grupid';
	
	$retrieve_data = $wpdb->get_results( "SELECT * FROM $table_name" );
?>

<h1 class="h1 text-center my-4">Grupid</h1>

<div class="container">
	<div class="row justify-content-md-center">
		<div class="col"></div>
		<div class="col-md-auto">
			<table class="table-striped table-hover border-0 mx-auto my-3 text-center">
				<thead>
					<tr>
						<th class="p-2">ID</th>
						<th class="p-2">Nimi</th>
						<th class="p-2">Struktuurüksuse ID</th>
						<th class="p-2">Üldmeil</th>
						<th class="p-2">Aktiivne</th>
						<th class="p-2"></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($retrieve_data as $retrieved_data){
						echo '<tr';
						if($retrieved_data->aktiivne == 'Ei') echo ' class="table-danger"';
						echo '>
						<td class="p-2">' . $retrieved_data->id . '</td>
						<td class="p-2">
							<form method="post" action=' . $isikud_url . '>
								<input type="number" value="' . $retrieved_data->id . '" name="id" hidden>
								<input value="' . $retrieved_data->nimi . '" type="submit" class="btn btn-info btn-sm">
							</form>
						</td>
						<td class="p-2">' . $retrieved_data->struktuuri_id . '</td>
						<td class="p-2">' . $retrieved_data->uldmeil . '</td>
						<td class="p-2">' . $retrieved_data->aktiivne . '</td>
						<td class="p-2">
							<div class="btn-group" id="' . $retrieved_data->id . '">
								<form method="post" action=' . $muudagrupp_url . '>
									<input type="number" value="' . $retrieved_data->id . '" name="id" hidden>
									<input value="Muuda" type="submit" class="btn btn-info btn-sm">
								</form>
								<button class="btn btn-danger btn-sm delete">Kustuta</button>
							</div>
						</td>
					</tr>';
					}?>
				</tbody>
			</table>
				<a  href=<?php echo $lisagrupp_url;?>>
					<button class="btn btn-info pull-right">+ Lisa grupp</button>
				</a>
		</div>
		<div class="col"></div>
	</div>
</div>
<script>
jQuery(document).ready(function() {
	jQuery(".delete").click(function() {
			var id = this.parentElement.id;
		
			var andmed = { action: "grupp_kustuta", id: id};
			
			$.ajax(ajaxurl, {
				"data": andmed,
				"type": "POST"
			})
			.done(function (result, status, xhr) {
				console.log(status);
			})
			.fail(function (xhr, status, error) {
				console.log("Result: " + status + " " + error + " " + xhr.status + " " + xhr.statusText);
			});
	});
})
</script>