<?php 
$lisaisik_url = str_replace('isikud','lisaisik',$url);
$muudaisik_url = str_replace('isikud','muudaisik',$url);
$url = str_replace('isikud', 'sunnipaevaplugin',$url);

$id = $_POST['id'];

global $wpdb;
	
	$table_name = $wpdb->prefix . 'isikud';
	
	$retrieve_data = $wpdb->get_results( "SELECT * FROM $table_name WHERE grupi_id=$id" );
?>

<h1 class="h1 text-center my-4">Isikud</h1>
<div class="container">
	<div class="row justify-content-md-center">
		<div class="col"></div>
		<div class="col col-md-auto">
			<div class="text-left">
				<a href=<?php echo $url; ?>>
					<button class="btn btn-danger">Tagasi</button>
				</a>
			</div>
			<table class="table-striped table-hover border-0 mx-auto text-center my-3">
				<thead>
					<tr>
						<th class="p-2">Eesnimi</th>
						<th class="p-2">Perenimi</th>
						<th class="p-2">Kuupäev</th>
						<th class="p-2">Email</th>
						<th class="p-2">Emaili saaja</th>
						<th class="p-2"><nobr>Grupi ID</nobr></th>
						<th class="p-2">Aktiivne</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($retrieve_data as $retrieved_data){
					echo '<tr';
					if($retrieved_data->aktiivne == 'Ei') echo ' class="table-danger"';
					echo '>
						<td class="p-2">' . $retrieved_data->eesnimi . '</td>
						<td class="p-2">' . $retrieved_data->perenimi . '</td>
						<td class="p-2">' . $retrieved_data->kuupaev . '</td>
						<td class="p-2"><nobr>' . $retrieved_data->email . '<nobr></td>
						<td class="p-2">' . $retrieved_data->saaja_email . '</td>
						<td class="p-2">' . $retrieved_data->grupi_id . '</td>	
						<td class="p-2">' . $retrieved_data->aktiivne . '</td>
						<td class="p-2">
							<div class="btn-group" id="' . $retrieved_data->id . '">
								<form method="post" action=' . $muudaisik_url . '>
									<input type="number" name="id" value="' . $retrieved_data->id . '" hidden>
									<input type="number" name="gid" value="' . $id . '" hidden>
									<input value="Muuda" type="submit" class="btn btn-info btn-sm">
								</form>
								<button type="button" class="btn btn-danger btn-sm delete">Kustuta</button>
							</div>
						</td>
					</tr>';
				}?>
				</tbody>
			</table>
			<div class="text-right">
				<form method="post" action=<?php echo $lisaisik_url;?>>
					<input type="number" name="id" value="<?php echo $id; ?>" hidden>
					<input value="+ Lisa isik" type="submit" class="btn btn-info btn-sm">
				</form>
			</div>
		</div>
		<div class="col"></div>
	</div>
</div>
<script>
jQuery(document).ready(function() {
	jQuery(".delete").click(function() {
			var id = this.parentElement.id;
		
			var andmed = { action: "isik_kustuta", id: id};
			
			$.ajax(ajaxurl, {
				"data": andmed,
				"type": "POST"
			})
			.done(function (result, status, xhr) {
				console.log(status);
			})
			.fail(function () {
				console.log("fail");
			});
	});
})
</script>