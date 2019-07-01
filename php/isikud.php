<?php
//Destination urls
$lisaisik_url = str_replace('isikud','lisaisik',$url);
$muudaisik_url = str_replace('isikud','muudaisik',$url);
$url = str_replace('isikud', 'sunnipaevaplugin',$url);

//ID of the group
$id = $_POST['id'];

//Acquiring the necessary data from the 'isikud' table
global $wpdb;
	
	$table_name = $wpdb->prefix . 'isikud';
	
	$retrieve_data = $wpdb->get_results( "SELECT * FROM $table_name WHERE grupi_id=$id" );
?>

<h1 class="h1 text-center my-4">Isikud</h1>

<div class="container">
	<div class="row justify-content-md-center">
		<div class="col"></div>
		<div class="col col-md-auto">
			<a href=<?php echo $url; ?>>
				<button class="btn btn-danger">Tagasi</button>
			</a>
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
					$eesnimi = $retrieved_data->eesnimi;
					$perenimi = $retrieved_data->perenimi;
					$kuupaev = $retrieved_data->kuupaev;
					$email = $retrieved_data->email;
					$saaja_email = $retrieved_data->saaja_email;
					$gid = $retrieved_data->grupi_id;
					$isiku_id = $retrieved_data->id;
					
					echo '<tr id="' . $isiku_id . '"';
					if($retrieved_data->aktiivne == 'Ei') echo ' class="table-danger"';
					echo '>
					
						<td class="p-2">' . $eesnimi . '</td>
						
						<td class="p-2">' . $perenimi . '</td>
						
						<td class="p-2">' . $kuupaev . '</td>
						
						<td class="p-2"><nobr>' . $email . '<nobr></td>
						
						<td class="p-2">' . $saaja_email . '</td>
						
						<td class="p-2">' . $gid . '</td>	
						
						<td class="p-2">
							<input type="checkbox" class="aktiivne" id="kast' . $isiku_id . '" ';
							if($retrieved_data->aktiivne == "Jah") {echo 'checked';}
							echo '>
						</td>
						
						<td class="p-2">
							<div class="btn-group">
							
								<form method="post" action=' . $muudaisik_url . '>
									<input type="number" name="id" value="' . $isiku_id . '" hidden>
									<input value="Muuda" type="submit" class="btn btn-info btn-sm">
								</form>
							
								<button type="button" class="btn btn-danger btn-sm delete">Kustuta</button>
							</div>
						</td>
					</tr>';
				}?>
				</tbody>
			</table>
			<form method="post" action=<?php echo $lisaisik_url;?>>
				<input type="number" name="id" value="<?php echo $gid; ?>" hidden>
				<input value="+ Lisa isik" type="submit" class="btn btn-info pull-right">
			</form>
		</div>
		<div class="col"></div>
	</div>
</div>
<script>
jQuery(document).ready(function() {
	jQuery(".delete").click(function() {
			var id = this.parentElement.parentElement.parentElement.id;
			$("tr#" + id).remove();
			
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
	
	jQuery(".aktiivne").click(function() {
			var rida = this.parentElement.parentElement;
			var id = rida.id;
			var kast = $("#kast" + id);
			var aktiivne = "Ei";
	
			if ( kast.is(':checked') ) {
				aktiivne = "Jah";
				rida.classList.remove("table-danger");
			}
			else{
				rida.classList.add("table-danger");
			}
			
			console.log(aktiivne);
			var andmed = { 
							action: "isik_muuda_aktiivsust",
							id: id,
							aktiivne: aktiivne
			};
			
			$.ajax(ajaxurl, {
				"data": andmed,
				"type": "POST"
			})
			.done(function () {
				console.log("done");
			})
			.fail(function() {
				console-log("fail");
			})
	});
})
</script>