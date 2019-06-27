<?php 
$inimesed_url = str_replace('sunnipaevaplugin','isikud',$url);
$muudagrupp_url = str_replace('sunnipaevaplugin','muudagrupp',$url);
$lisagrupp_url = str_replace('sunnipaevaplugin','lisagrupp',$url);

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
				echo '<tr>
						<td class="p-2">' . $retrieved_data->id . '</td>
						<td class="p-2">
							<a href="' . $inimesed_url . '" class="text-info">' . $retrieved_data->nimi . '</a>
						</td>
						<td class="p-2">' . $retrieved_data->struktuuri_id . '</td>
						<td class="p-2">' . $retrieved_data->uldmeil . '</td>
						<td class="p-2">' . $retrieved_data->aktiivne . '</td>
						<td class="p-2">
							<div class="btn-group">
								<form method="post" action=' . $muudagrupp_url . '>
									<input type="number" id="' . $retrieved_data->id . '" name="id" value="' . $retrieved_data->id . '" hidden>
									<input value="Muuda" type="submit" class="btn btn-info btn-sm">
								</form>
								<button class="btn btn-danger btn-sm delete">Kustuta</button>
							</div>
						</td>
					</tr>';}?>
				</tbody>
			</table>
			<div  class="text-right">
				<a  href=<?php echo $lisagrupp_url;?>>
					<button class="btn btn-info">+ Lisa grupp</button>
				</a>
			</div>
		</div>
		<div class="col"></div>
	</div>
</div>
<script>
jQuery(document).ready(function() {
	jQuery(".delete").on("click", function(event) {
			var andmed = { action: "grupp_kustuta", id: 1};
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